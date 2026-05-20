<?php
// 1. Добавляем мета-бокс на страницу редактирования видеоотзыва
function review_add_meta_boxes() {
    add_meta_box(
        'review_details_meta_box',   // ID
        'Детали видеоотзыва',         // Заголовок
        'review_meta_box_callback',  // Callback функция
        'review',                    // Название CPT
        'normal',                    // Контекст (normal, side, advanced)
        'high'                       // Приоритет
    );
}
add_action('add_meta_boxes', 'review_add_meta_boxes');

// 2. Отображаем поля в мета-боксе
function review_meta_box_callback($post) {
    // Добавляем nonce для проверки безопасности
    wp_nonce_field('review_save_meta_data', 'review_meta_nonce');

    // Получаем сохранённые значения
    $video_id = get_post_meta($post->ID, '_review_video_id', true);
    $full_name = get_post_meta($post->ID, '_review_full_name', true);
    $position = get_post_meta($post->ID, '_review_position', true);
    $organization = get_post_meta($post->ID, '_review_organization', true);
    ?>

    <style>
        .review-meta-field {
            margin-bottom: 20px;
        }
        .review-meta-field label {
            display: block;
            font-weight: 600;
            margin-bottom: 8px;
        }
        .review-meta-field input[type="text"],
        .review-meta-field textarea {
            width: 100%;
            max-width: 500px;
            padding: 8px;
        }
        .video-preview {
            margin-top: 10px;
            max-width: 400px;
        }
        .video-preview video {
            width: 100%;
            height: auto;
        }
    </style>

    <!-- Поле прикрепления видео из медиабиблиотеки -->
    <div class="review-meta-field">
        <label for="review_video_id">Видеофайл</label>
        <input type="hidden" id="review_video_id" name="review_video_id" value="<?php echo esc_attr($video_id); ?>">
        <button type="button" class="button upload-video-button">Выбрать видео</button>
        <button type="button" class="button remove-video-button" style="<?php echo $video_id ? '' : 'display:none;' ?>">Удалить видео</button>
        <div class="video-preview">
            <?php if ($video_id) : 
                $video_url = wp_get_attachment_url($video_id);
                $video_mime = get_post_mime_type($video_id);
                if ($video_url && strpos($video_mime, 'video/') === 0) : ?>
                    <video controls src="<?php echo esc_url($video_url); ?>"></video>
                <?php endif; 
            endif; ?>
        </div>
        <p class="description">Выберите видеофайл из медиабиблиотеки</p>
    </div>

    <!-- Поле "Имя Фамилия" -->
    <div class="review-meta-field">
        <label for="review_full_name">Имя Фамилия</label>
        <input type="text" id="review_full_name" name="review_full_name" value="<?php echo esc_attr($full_name); ?>" placeholder="Например: Иван Петров">
    </div>

    <!-- Поле "Должность" -->
    <div class="review-meta-field">
        <label for="review_position">Должность</label>
        <input type="text" id="review_position" name="review_position" value="<?php echo esc_attr($position); ?>" placeholder="Например: Руководитель отдела">
    </div>

    <!-- Поле "Организация" -->
    <div class="review-meta-field">
        <label for="review_organization">Организация</label>
        <input type="text" id="review_organization" name="review_organization" value="<?php echo esc_attr($organization); ?>" placeholder="Например: ООО «Ромашка»">
    </div>

    <script>
    jQuery(document).ready(function($) {
        // Кнопка выбора видео
        $('.upload-video-button').on('click', function(e) {
            e.preventDefault();
            var button = $(this);
            var frame = wp.media({
                title: 'Выберите видео',
                library: { type: 'video' },
                button: { text: 'Выбрать' },
                multiple: false
            });
            frame.on('select', function() {
                var attachment = frame.state().get('selection').first().toJSON();
                $('#review_video_id').val(attachment.id);
                var videoHtml = '<video controls src="' + attachment.url + '"></video>';
                $('.video-preview').html(videoHtml);
                $('.remove-video-button').show();
            });
            frame.open();
        });

        // Кнопка удаления видео
        $('.remove-video-button').on('click', function(e) {
            e.preventDefault();
            $('#review_video_id').val('');
            $('.video-preview').html('');
            $(this).hide();
        });
    });
    </script>
    <?php
}

// 3. Сохраняем мета-данные
function review_save_meta_data($post_id) {
    // Проверки безопасности
    if (!isset($_POST['review_meta_nonce']) || !wp_verify_nonce($_POST['review_meta_nonce'], 'review_save_meta_data')) {
        return;
    }
    if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE) {
        return;
    }
    if (!current_user_can('edit_post', $post_id)) {
        return;
    }
    if (get_post_type($post_id) !== 'review') {
        return;
    }

    // Сохраняем ID видео
    if (isset($_POST['review_video_id'])) {
        update_post_meta($post_id, '_review_video_id', intval($_POST['review_video_id']));
    }

    // Сохраняем текстовые поля
    $text_fields = ['review_full_name', 'review_position', 'review_organization'];
    foreach ($text_fields as $field) {
        if (isset($_POST[$field])) {
            update_post_meta($post_id, '_' . $field, sanitize_text_field($_POST[$field]));
        }
    }
}
add_action('save_post', 'review_save_meta_data');

// 4. Подключаем скрипты медиазагрузчика (только на странице редактирования review)
function review_enqueue_media_scripts($hook) {
    global $post;
    if ($hook === 'post.php' || $hook === 'post-new.php') {
        if ($post && $post->post_type === 'review') {
            wp_enqueue_media();
            wp_enqueue_script('jquery');
        }
    }
}
add_action('admin_enqueue_scripts', 'review_enqueue_media_scripts');