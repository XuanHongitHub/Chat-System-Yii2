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
// Khai báo biến tagify ở cấp độ cao hơn
var tagify;

document.addEventListener('DOMContentLoaded', function () {
    var input = document.querySelector('#members');
    tagify = new Tagify(input); // Gán biến tagify tại đây

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
        event.preventDefault();

        var roomName = $('#roomName').val();
        var members = tagify.value;

        var memberData = members.map(function (member) {
            return { id: member.id };
        });

        $.ajax({
            type: 'POST',
            url: '/chat/add-room',
            headers: {
                'X-CSRF-Token': getCsrfToken()
            },
            data: {
                room_name: roomName,
                members: JSON.stringify(memberData)
            },
            success: function (response) {
                if (response.status === 'success') {
                    $('#response-message').html('<div class="alert alert-success">' + response.message + '</div>');
                    setTimeout(function () {
                        $('#addRoomModal').modal('hide');
                    }, 5000);
                } else {
                    $('#response-message').html('<div class="alert alert-danger">' + response.message + '</div>');
                }
            },
            error: function (xhr, status, error) {
                $('#response-message').html('<div class="alert alert-danger">Có lỗi xảy ra: ' + error + '</div>');
            }
        });
    });
});
