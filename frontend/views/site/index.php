<?php

/** @var yii\web\View $this */

$this->title = 'My Yii Application';
?>
<div class="site-index">
    <div class="p-5 mb-4 bg-transparent rounded-3">
        <div class="container-fluid py-5 text-center">
            <h1 class="display-4">Congratulations!</h1>
            <p class="fs-5 fw-light">You have successfully created your Yii-powered application.</p>
            <p><a class="btn btn-lg btn-success" href="https://www.yiiframework.com">Get started with Yii</a></p>
        </div>
    </div>

    <div class="body-content">

        <div class="row">
            <?php
            $script = <<< JS
                const socket = io('http://localhost:3000');

                socket.on('chat message', (msg) => {
                    const messages = document.getElementById('messages');
                    // messages.innerHTML;
                    messages.scrollTop = messages.scrollHeight; // Auto-scroll to bottom
                });

                document.getElementById('send').onclick = function() {
                    const input = document.getElementById('input');
                    socket.emit('chat message', input.value);
                    input.value = '';
                };
            JS;

            $this->registerJs($script);
            ?>
        </div>

    </div>
</div>