function submitAddContact() {
    const username = document.getElementById('contactUsername').value;
    if (username) {
        fetch('/chat/add-contact', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
                'X-CSRF-Token': getCsrfToken() // Sử dụng hàm lấy CSRF token
            },
            body: new URLSearchParams({ username: username })
        })
            .then(response => response.json())
            .then(data => {
                if (data.status === 'success') {
                    console.log(data.message);
                    $('#addContactModal').modal('hide');
                    document.getElementById('addContactForm').reset();
                    updateContactList(); // Cập nhật danh sách liên hệ sau khi thêm mới
                } else {
                    alert(data.message);
                }
            })
            .catch(error => console.error('Error:', error));
    } else {
        alert('Vui lòng nhập tên tài khoản.');
    }
}

function getCsrfToken() {
    return document.querySelector('meta[name="csrf-token"]').getAttribute('content');
}

// function updateContactList() {
//     fetch('/chat/get-contacts')
//         .then(response => response.json())
//         .then(data => {
//             if (data && Array.isArray(data)) {
//                 // Giả sử bạn có một thẻ để hiển thị danh sách liên hệ
//                 const contactListElement = document.getElementById('contactList');
//                 contactListElement.innerHTML = ''; // Xóa danh sách hiện tại

//                 data.forEach(contact => {
//                     const contactItem = document.createElement('li');
//                     contactItem.textContent = contact.username; // Hiển thị tên người dùng
//                     contactItem.setAttribute('data-id', contact.id); // Lưu ID cho từng liên hệ
//                     contactListElement.appendChild(contactItem); // Thêm vào danh sách
//                 });
//             } else {
//                 console.error('Data format is not correct:', data);
//             }
//         })
//         .catch(error => console.error('Error fetching contacts:', error));
// }

// Khi tài liệu được tải xong
document.addEventListener('DOMContentLoaded', function () {
    var input = document.querySelector('#chat_room_user');
    var tagify = new Tagify(input);

    // Lấy danh sách liên hệ và thêm vào Tagify
    fetch('/chat/get-contacts')
        .then(response => response.json())
        .then(data => {
            if (data && Array.isArray(data)) {
                const tags = data.map(contact => ({
                    value: contact.username,
                    id: contact.id
                }));
                tagify.addTags(tags);
            } else {
                console.error('Data format is not correct:', data);
            }
        })
        .catch(error => console.error('Error fetching contacts:', error));
});

$(document).ready(function () {
    $('#addRoomButton').on('click', function (event) {
        // Ngăn chặn hành động gửi form mặc định
        event.preventDefault();

        // Lấy dữ liệu từ form
        var roomName = $('#roomName').val(); // Lấy tên phòng từ input
        var members = $('#chat_room_user').val(); // Lấy danh sách thành viên từ input

        // Chuyển danh sách thành viên thành mảng nếu cần
        // Giả sử thành viên được nhập dưới dạng chuỗi, phân cách bởi dấu phẩy
        members = members ? members.split(',').map(function (member) {
            return member.trim(); // Loại bỏ khoảng trắng
        }) : [];

        // Chuyển đổi thành chuỗi JSON
        var memberData = members.map(function (id) {
            return { id: id }; // Tạo đối tượng với thuộc tính id
        });

        // Gửi yêu cầu AJAX
        $.ajax({
            type: 'POST',
            url: '/chat/add-room', // Cập nhật đường dẫn tới action trong controller
            headers: {
                'X-CSRF-Token': getCsrfToken() // Thêm CSRF token nếu cần
            },
            data: {
                room_name: roomName,
                members: JSON.stringify(memberData) // Chuyển đổi mảng thành chuỗi JSON
            },
            success: function (response) {
                // Xử lý phản hồi thành công từ server
                if (response.status === 'success') {
                    $('#response-message').html('<div class="alert alert-success">' + response.message + '</div>'); // Hiển thị thông báo thành công
                    $('#addRoomModal').modal('hide'); // Đóng modal
                    // Có thể thêm mã để làm mới danh sách phòng chat ở đây
                } else {
                    $('#response-message').html('<div class="alert alert-danger">' + response.message + '</div>'); // Hiển thị thông báo lỗi
                }
            },
            error: function (xhr, status, error) {
                // Xử lý lỗi khi gửi yêu cầu AJAX
                $('#response-message').html('<div class="alert alert-danger">Có lỗi xảy ra: ' + error + '</div>');
            }
        });
    });
});
