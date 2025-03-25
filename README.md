# 📚 Student Management

**Student Management** là một công cụ **quản lý sinh viên** đơn giản, hỗ trợ các thao tác **CRUD (Create - Read - Update - Delete)**.  
Ứng dụng được xây dựng bằng **PHP thuần kết hợp với MySQL**, giúp quản lý danh sách sinh viên dễ dàng và hiệu quả.

🚀 **Phiên bản:** 1.0  
🛠 **Tác giả:** [DuckSoSad](https://github.com/DuckSoSad)

---

## 🚀 Tính năng nổi bật

✅ **Quản lý sinh viên** với đầy đủ thông tin:

- Họ tên
- Email
- Số điện thoại
- Ngày sinh
- Giới tính
- Ảnh đại diện
- Địa chỉ
- Ngành học
- Khoá học

✅ **Xem danh sách sinh viên** với giao diện trực quan, hỗ trợ **phân trang**.  
✅ **Chỉnh sửa thông tin sinh viên** dễ dàng ngay trên giao diện web.  
✅ **Xoá sinh viên** nhanh chóng chỉ với một cú click.  
✅ **Tìm kiếm và lọc sinh viên** theo nhiều tiêu chí.  
✅ **Upload ảnh đại diện** sinh viên, hỗ trợ kiểm tra định dạng ảnh hợp lệ.  
✅ **Giao diện đẹp**, tối ưu UX/UI với **TailwindCSS**.  
✅ **Dữ liệu được lưu trữ và xử lý an toàn với MySQL**.

---

## 📌 Công nghệ sử dụng

| **Công nghệ**          | **Mô tả**                     |
| ---------------------- | ----------------------------- |
| 🛠 **Backend**          | PHP thuần                     |
| 🎨 **Frontend**        | HTML, TailwindCSS, JavaScript |
| 💾 **Database**        | MySQL                         |
| 🔄 **Version Control** | Git & GitHub                  |

---

## 📥 Cài đặt và chạy dự án

### 1️⃣ Clone repository

```bash
git clone https://github.com/DuckSoSad/student_management.git
cd student_management
2️⃣ Cấu hình cơ sở dữ liệu
Tạo database student_management trong MySQL.

Import file database.sql có sẵn trong thư mục project.

Cấu hình kết nối database trong file config.php:

php
Sao chép
Chỉnh sửa
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'student_management');
3️⃣ Chạy project
Nếu bạn đang sử dụng Laragon/XAMPP, chỉ cần truy cập trình duyệt và mở đường dẫn:

👉 http://localhost/student_management

🎯 Hướng dẫn sử dụng
🔹 Truy cập trang chủ để xem danh sách sinh viên.
🔹 Bấm nút "Thêm sinh viên" để thêm mới.
🔹 Chỉnh sửa thông tin sinh viên bằng cách bấm nút "Sửa".
🔹 Xoá sinh viên nếu không còn cần thiết.
🔹 Sử dụng ô tìm kiếm để lọc danh sách nhanh chóng.

📷 Giao diện ứng dụng
🎨 Màn hình danh sách sinh viên

📋 Màn hình thêm sinh viên

🛠 Đóng góp & phát triển
Mọi ý kiến đóng góp, tính năng mới hoặc báo cáo lỗi, vui lòng mở Issue hoặc gửi Pull Request trên GitHub.

💡 Hướng dẫn đóng góp
Fork repository này.

Tạo một branch mới để phát triển tính năng (git checkout -b feature-new)

Commit thay đổi của bạn (git commit -m "Thêm tính năng XYZ")

Đẩy code lên (git push origin feature-new)

Tạo Pull Request để xem xét.

📩 Liên hệ
📧 Email: tdkhangg2004@gmail.com
🐙 GitHub: DuckSoSad

⭐ Hỗ trợ dự án
Nếu bạn thấy dự án hữu ích, hãy:
🌟 Star repo này trên GitHub!
🍵 Mua cho tác giả một cốc cà phê (nếu thích 😂)

📌 Bản quyền © 2025 DuckSoSad
📄 Giấy phép: MIT License
```
