<?php

use yii\bootstrap5\Nav;

?>

<nav class="menu">
    <ul class="items">
        <li class="item">
            <i class="fa-solid fa-house"></i>
        </li>
        <li class="item">
            <i class="fas fa-user" aria-hidden="true"></i>
        </li>
        <li class="item">
            <i class="fas fa-pencil-alt" aria-hidden="true"></i>
        </li>
        <li class="item item-active">
            <i class="fas fa-comments" aria-hidden="true"></i>
        </li>
        <li class="item">
            <i class="fas fa-file-alt" aria-hidden="true"></i>
        </li>
        <li class="item">
            <i class="fas fa-cog" aria-hidden="true"></i>
        </li>
    </ul>
</nav>

<section class="discussions">
    <div class="user-list">
        <div class="discussion search">
            <div class="searchbar">
                <i class="fa fa-search" aria-hidden="true"></i>
                <input type="text" placeholder="Tìm kiếm..."></input>
            </div>
        </div>
        <div class="header-title">
            <span>Contact</span>
            <div icon="outline-add-new-contact-2" data-bs-toggle="modal" data-bs-target="#addContactModal"
                class="z--btn--v2 btn-tertiary-neutral medium --rounded icon-only" title="Thêm bạn">
                <i class="fa fa-plus pre"></i>
            </div>
        </div>
        <!-- Modal Thêm liên hệ -->
        <div id="addContactModal" tabindex="-1" aria-labelledby="addContactModalLabel" aria-hidden="true"
            class="modal fade">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addContactModalLabel">Thêm liên hệ mới</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <form id="addContactForm">
                            <div class="form-group">
                                <label for="contactUsername">Tên tài khoản <span class="text-danger">*</span></label>
                                <input type="text" id="contactUsername" class="form-control"
                                    placeholder="Nhập tên tài khoản" required>
                            </div>
                        </form>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
                        <button type="button" class="btn btn-primary" onclick="submitAddContact()">Thêm liên hệ</button>
                    </div>
                </div>
            </div>
        </div>


        <div class="discussion message-active">
            <div class="photo"
                style="background-image: url(https://images.unsplash.com/photo-1438761681033-6461ffad8d80?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=1050&q=80);">
                <div class="online"></div>
            </div>
            <div class="desc-contact">
                <p class="name">Megan Leib</p>
                <p class="message">9 pm at the bar if possible 😳</p>
            </div>
            <div class="timer">12 giây</div>
        </div>

        <div class="discussion">
            <div class="photo"
                style="background-image: url(https://i.pinimg.com/originals/a9/26/52/a926525d966c9479c18d3b4f8e64b434.jpg);">
                <div class="online"></div>
            </div>
            <div class="desc-contact">
                <p class="name">Dave Corlew</p>
                <p class="message">Let's meet for a coffee or something today?</p>
            </div>
            <div class="timer">3 phút</div>
        </div>

    </div>
    <div class="room-list">
        <div class="header-title">
            <span>Rooms</span>
            <div icon="outline-add-new-contact-2" data-bs-toggle="modal" data-bs-target="#addRoomModal" class=""
                title="Thêm bạn">
                <i class="fa fa-plus pre"></i>
            </div>
        </div>
        <!-- Modal -->
        <div id="addRoomModal" tabindex="-1" aria-labelledby="addRoomModalLabel" aria-hidden="true" class="modal fade">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="addRoomModalLabel">Create Room</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="card-body">
                            <div class="mb-4" id="response-message"></div>

                            <div class="form-group mb-4">
                                <label for="roomName" class="fw-medium">Name <span class="text-danger">*</span></label>
                                <input type="text" class="form-control" name="roomName" id="roomName"
                                    placeholder="Enter room name">
                            </div>
                            <div class="form-group mb-4">
                                <label for="members" class="fw-medium">Members <span
                                        class="text-danger">*</span></label>
                                <input name="members" placeholder="Enter members" class="form-control"
                                    id="members">
                            </div>
                            <div class="form-group mb-4">
                                <label for="visibility" class="fw-medium">Visibility <span
                                        class="text-danger">*</span></label>
                                <select class="form-select" name="visibility" id="visibility">
                                    <option value="0" selected>Private</option>
                                    <option value="1">Public</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="button" id="addRoomButton" class="btn btn-primary">Thêm phòng</button>
                    </div>
                </div>
            </div>
        </div>

        <div class="discussion">
            <div class="photo"
                style="background-image: url(https://images.unsplash.com/photo-1497551060073-4c5ab6435f12?ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&ixlib=rb-1.2.1&auto=format&fit=crop&w=667&q=80);">
            </div>
            <div class="desc-contact">
                <p class="name">Jerome Seiber</p>
                <p class="message">I've sent you the annual report</p>
            </div>
            <div class="timer">42 phút</div>
        </div>

        <div class="discussion">
            <div class="photo" style="background-image: url(https://card.thomasdaubenton.com/img/photo.jpg);">
                <div class="online"></div>
            </div>
            <div class="desc-contact">
                <p class="name">Thomas Dbtn</p>
                <p class="message">See you tomorrow! 🙂</p>
            </div>
            <div class="timer">2 giờ</div>
        </div>

    </div>
</section>


<?php

?>