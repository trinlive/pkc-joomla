<?php
// ---------------------------
// 🔧 ตั้งค่าเริ่มต้น
// ---------------------------
$target_dir = "uploads/";
$log_dir = "logs/";
$log_file = $log_dir . "upload_log.csv";
$max_size = 10 * 1024 * 1024; // 10MB
$allowed = ["jpg", "jpeg", "png", "pdf", "docx"];
$line_token = "YOUR_LINE_TOKEN"; // ✅ ใส่ LINE Notify Token ของคุณ
$admin_email = "it.admin@pakkretcity.go.th"; // ✅ ใส่อีเมลที่ต้องการรับแจ้งเตือน

// ---------------------------
// ตรวจสอบ / สร้างโฟลเดอร์
// ---------------------------
if (!is_dir($target_dir)) mkdir($target_dir, 0777, true);
if (!is_dir($log_dir)) mkdir($log_dir, 0777, true);

// ---------------------------
// 📋 รับข้อมูลจากฟอร์ม
// ---------------------------
$fullname = htmlspecialchars($_POST["fullname"]);
$phone = htmlspecialchars($_POST["phone"]);
$email = htmlspecialchars($_POST["email"]);
$lineid = htmlspecialchars($_POST["lineid"]);
$report_detail = htmlspecialchars($_POST["report_detail"]);

// ---------------------------
// 📦 อัปโหลดไฟล์
// ---------------------------
$uploaded_files = [];
foreach ($_FILES["files"]["tmp_name"] as $key => $tmp_name) {
    $file_name = basename($_FILES["files"]["name"][$key]);
    $file_size = $_FILES["files"]["size"][$key];
    $file_type = strtolower(pathinfo($file_name, PATHINFO_EXTENSION));

    if (!in_array($file_type, $allowed)) continue;
    if ($file_size > $max_size) continue;

    $new_name = uniqid("upload_", true) . "." . $file_type;
    $final_path = $target_dir . $new_name;

    if (move_uploaded_file($tmp_name, $final_path)) {
        $uploaded_files[] = $new_name;
    }
}

if (count($uploaded_files) == 0) {
  die("❌ ไม่สามารถอัปโหลดไฟล์ได้");
}

// ---------------------------
// 🧾 บันทึก Log เป็น .csv
// ---------------------------
$time = date("Y-m-d H:i:s");
$log_data = [$time, $fullname, $phone, $email, $lineid, $report_detail, implode(", ", $uploaded_files)];
$file = fopen($log_file, "a");
fputcsv($file, $log_data);
fclose($file);

// ---------------------------
// 📧 แจ้งเตือนทางอีเมล
// ---------------------------
$subject = "📥 รายงานจาก $fullname";
$message = "
มีรายงานการพบใหม่:

ชื่อ-นามสกุล: $fullname
เบอร์โทร: $phone
อีเมล: $email
LINE ID: $lineid

รายละเอียดการรายงาน:
$report_detail

ไฟล์แนบ:
" . implode(", ", $uploaded_files) . "

เวลา: $time
";

mail($admin_email, $subject, $message);

// ---------------------------
// 💬 แจ้งเตือนผ่าน LINE Notify
// ---------------------------
$line_message = "📢 รายงานการพบใหม่\n".
"ชื่อ: $fullname\n".
"โทร: $phone\n".
"Line ID: $lineid\n".
"รายละเอียด: $report_detail\n".
"ไฟล์: ".implode(", ", $uploaded_files)."\n".
"เวลา: $time";

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://notify-api.line.me/api/notify");
curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, "message=" . urlencode($line_message));
curl_setopt($ch, CURLOPT_HTTPHEADER, array("Authorization: Bearer " . $line_token));
curl_exec($ch);
curl_close($ch);

// ---------------------------
// ✅ แสดงข้อความสำเร็จ
// ---------------------------
echo "✅ ขอบคุณ $fullname ระบบได้รับรายงานของคุณเรียบร้อยแล้ว";
?>
