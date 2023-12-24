----Hướng dẫn cài đặt và sử dụng 
Vì dùng xampp nên phải có xampp để chạy được web vì em đã sửa phiên bản trong xampp nên nhiều cái đã thay đổi và em không thể up xampp lên github và quá dung lượng 

Nên đây là link liên kết để tải xampp em đã up lên drive (https://drive.google.com/file/d/1pm6JHwfPe8jQotogOGz4h3I0qlJcjv4n/view?usp=sharing) mong thầy thông cảm ạ

Khi tải xampp ở trong link về thì giải nén trong ổ C

Khi giải nén thành công thì tạo biến môi trường cho nó để chạy được xampp

Trong thanh tìm kiếm trên window gõ Edit the system enviroment variables

Chọn Enviroment variables -> Trong System variables chọn Path xong chọn Edit -> Kiểm tra xem biến môi trường đã có từ trước chưa 

Nếu có rồi thì xóa đi thường là biến của wamp ( không thể gắn 2 cái wamp và xampp vì chạy sẽ bị xung đột nên chỉ dùng một biến môi trường)

Nếu chưa có thì chọn New xong dán đường dẫn từ ổ C tới php trong xampp ( ví dụ C:\xampp\php ) -> OK là hoàn thành 

Vào cmd kiểm tra xem php đã đúng version hay chưa bằng lệnh : php --version  (ra php 7.3 là đúng ạ)

Hoàn thành việc cài đặt xampp.

Vào phần htdocs trong xampp đã có source code của đồ án trong đó sẵn nên không cần tải từ trên github về nữa

Phần database trong phpadmin cũng đã có sẵn giờ chỉ việc chạy

----Chạy website :

Mở xampp -> chọn xampp-control.exe -> hiện ra bảng chọn khi tải lần đầu tích chọn mục apache và mysql để nó tải về (tích xanh là tải về thành công) -> start ( start lần đầu nó hiện ra bảng cần chấp nhận để nó chạy thì ấn accept )

Xong thì start Apache và Mysql -> Chọn Admin của Apache để ra localhost

Chọn Admin của Mysql để dẫn đến PhpAdmin để kiểm tra xem đã có database banhang trên đó chưa

Nếu có thì quay lại localhost của Apache trỏ đến đường dẫn của đồ án ( Ví dụ http://localhost/DoAnChuyenNganh/ )

Trang Admin ( http://localhost/DoAnChuyenNganh/admin ) -> tài khoản admin , mật khẩu admin123 : Để đăng nhập tài khoản Admin

Đến đây nếu ra website không có lỗi gì là thành công rồi ạ.

Cảm ơn thầy đã đọc hướng dẫn của em ạ <3

----Hosting tiutiu.online 
https://nuremberg.maychu.cloud:2222/CMD_FILE_MANAGER?path=/  ( vào trang này để đăng nhập tài khoản trên hosting )

Tài khoản : tiutiuon

Mật khẩu : NgocLinh25122001

Phần source code nằm trong public_html
https://nuremberg.maychu.cloud:2222/evo/ ( trang chính của hosting )



