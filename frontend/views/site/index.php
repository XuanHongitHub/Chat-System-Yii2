<?php

/** @var yii\web\View $this */

use yii\helpers\Html;
use yii\helpers\Json;

$this->title = 'My Yii Application';
?>
<?php echo $this->render('@frontend/views/layouts/_sidebar', [
    'contacts' => $contacts,
    'activeContactId' => $activeContactId,
    'roomData' => $roomData,
]); ?>

<section class="chat">
    <div class="header-chat">
        <i class="icon fa fa-user-o" aria-hidden="true"></i>
        <p class="name" id="chatTitle"></p>
        <i class="icon clickable fa fa-ellipsis-h right" aria-hidden="true"></i>
    </div>

    <div class="messages-chat" id="messagesChat">
        <div class="message">
            <div class="photo"
                style="background-image: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80);">
                <div class="online"></div>
            </div>
            <p class="text"> Hi, how are you ? </p>
        </div>
        <div class="message text-only">
            <p class="text"> What are you doing tonight ? Want to go take a drink ?</p>
        </div>
        <p class="time"> 14h58</p>
        <div class="message text-only">
            <div class="response">
                <p class="text"> Hey Megan ! It's been a while 😃</p>
            </div>
        </div>
        <div class="message text-only">
            <div class="response">
                <p class="text"> When can we meet ?</p>
            </div>
        </div>
        <p class="response-time time"> 15h04</p>
        <div class="message">
            <div class="photo"
                style="background-image: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80);">
                <div class="online"></div>
            </div>
            <p class="text"> 9 pm at the bar if possible 😳</p>
        </div>
        <p class="time"> 15h09</p>
    </div>

    <div class="footer-chat">
        <input type="hidden" id="currentChatId" value="">
        <input type="hidden" id="isRoom" value="">
        <i class="icon fa fa-smile-o clickable" style="font-size:25pt;" aria-hidden="true"></i>
        <textarea class="write-message" id="messageInput" placeholder="Type your message here"></textarea>
        <i class="icon send fa fa-paper-plane-o clickable" id="sendMessageButton" aria-hidden="true"></i>
    </div>
</section>
<script>
document.getElementById('messageInput').addEventListener('keydown', function(event) {
    if (event.key === 'Enter') {
        event.preventDefault();
        document.getElementById('sendMessageButton').click();
    }
});
</script>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>