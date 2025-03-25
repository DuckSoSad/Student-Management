📚 Student Management

Student Management là một công cụ quản lý sinh viên đơn giản, hỗ trợ các thao tác CRUD (Create - Read - Update - Delete). Ứng dụng được xây dựng bằng PHP thuần kết hợp với MySQL, giúp quản lý danh sách sinh viên dễ dàng và hiệu quả.

🚀 Tính năng nổi bật

✅ Thêm sinh viên với đầy đủ thông tin: Họ tên, Email, Số điện thoại, Ngày sinh, Giới tính, Ảnh đại diện, Địa chỉ, Ngành học, Khoá học.

✅ Xem danh sách sinh viên với giao diện trực quan, hỗ trợ phân trang.

✅ Chỉnh sửa thông tin sinh viên dễ dàng ngay trên giao diện web.

✅ Xoá sinh viên nhanh chóng chỉ với một cú click.

✅ Tìm kiếm và lọc sinh viên theo nhiều tiêu chí.

✅ Upload ảnh đại diện sinh viên, hỗ trợ kiểm tra định dạng ảnh hợp lệ.

✅ Giao diện đẹp, tối ưu UX/UI với TailwindCSS.

✅ Dữ liệu được lưu trữ và xử lý an toàn với MySQL.

📌 Công nghệ sử dụng

Backend: PHP thuần + MySQL

Frontend: HTML, TailwindCSS, JavaScript

Database: MySQL

Version Control: Git & GitHub

📥 Cài đặt và chạy dự án

1️⃣ Clone repository

git clone https://github.com/DuckSoSad/student_management.git
cd student_management

2️⃣ Cấu hình cơ sở dữ liệu

Tạo database student_management trong MySQL.

Import file database.sql có sẵn trong thư mục project.

Cấu hình kết nối database trong file config.php:

define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'student_management');

3️⃣ Chạy project

Nếu bạn đang sử dụng Laragon/XAMPP, chỉ cần truy cập trình duyệt và mở đường dẫn:

http://localhost/student_management

🎯 Hướng dẫn sử dụng

Truy cập trang chủ để xem danh sách sinh viên.

Bấm nút Thêm sinh viên để thêm mới.

Chỉnh sửa thông tin sinh viên bằng cách bấm nút Sửa.

Xoá sinh viên nếu không còn cần thiết.

Sử dụng ô tìm kiếm để lọc danh sách nhanh chóng.

🎨 Giao diện

🛠 Đóng góp & phát triển

Mọi ý kiến đóng góp, tính năng mới hoặc báo cáo lỗi, vui lòng mở Issue hoặc gửi Pull Request trên GitHub.

📩 Liên hệ: tdkhangg2004@gmail.com

⭐ Nếu thấy hữu ích, hãy cho repo này một star nhé! ⭐
