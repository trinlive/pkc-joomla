นี่คือชุดคำสั่งที่คัดมาเฉพาะสำหรับ **`pakkretcity.go.th`** ครับ เนื่องจากเราทราบแล้วว่า Traffic ส่วนใหญ่อยู่ที่ **Nginx Log (`proxy_access_ssl_log`)** คำสั่งเหล่านี้จะเน้นไปที่ไฟล์นั้นเพื่อให้เจอข้อมูลแน่นอนครับ

คุณสามารถ **Copy** ไปวางทีละบรรทัดได้เลยครับ:

### 1. 📺 ดู Traffic แบบสดๆ (Real-time Monitor)

ใช้ดูว่าใครกำลังเข้าเว็บอยู่ ณ วินาทีนี้ (กด `Ctrl + C` เพื่อออก)

```bash
tail -f /var/www/vhosts/system/pakkretcity.go.th/logs/proxy_access_ssl_log

```

---

### 2. 🚨 หา Error ร้ายแรง (เว็บล่ม/เว็บพัง)

ใช้หา Code 500, 502, 503, 504 (Server Error)

```bash
grep " HTTP/2.0\" 5" /var/www/vhosts/system/pakkretcity.go.th/logs/proxy_access_ssl_log | tail -n 20

```

---

### 3. ⚠️ หาคนเข้าแล้วไม่เจอหน้าเว็บ (404 Not Found)

ใช้เช็คว่ามีลิงก์เสีย หรือมี Bot พยายามสุ่มหาไฟล์แปลกๆ หรือไม่

```bash
grep " HTTP/2.0\" 404" /var/www/vhosts/system/pakkretcity.go.th/logs/proxy_access_ssl_log | tail -n 20

```

---

### 4. 🕵️‍♂️ จับโจร! ดู IP ที่เข้ามาถล่มเยอะที่สุด (Top 10 IP)

คำสั่งนี้จะช่วยนับว่า IP ไหนเข้ามาเยอะผิดปกติ (เอาไว้ Block ใน Firewall)

```bash
awk '{print $1}' /var/www/vhosts/system/pakkretcity.go.th/logs/proxy_access_ssl_log | sort | uniq -c | sort -nr | head -n 10

```

---

### 5. 🔐 ดูใครพยายาม Login หรือส่งข้อมูล (POST Request)

ใช้เช็คว่ามีใครพยายามเจาะระบบ Login หรือ Spam Form หรือไม่

```bash
grep "POST " /var/www/vhosts/system/pakkretcity.go.th/logs/proxy_access_ssl_log | tail -n 20

```

---

### 6. 🐛 ดู Error ของ PHP (backend)

อันนี้ต้องเช็คที่ `error_log` ปกติ (เผื่อ code PHP พัง)

```bash
tail -n 20 /var/www/vhosts/system/pakkretcity.go.th/logs/error_log

```

---

**💡 ข้อสังเกต:**
สำหรับโดเมนนี้ ผมแนะนำให้เน้นใช้คำสั่งในข้อ **1** และ **4** บ่อยๆ ครับ เพราะเว็บราชการมักจะโดน Bot มาสแกนหรือดูดข้อมูล (Scraping) จนเครื่องช้า การดู Top IP จะช่วยให้ตัดสินใจบล็อกได้แม่นยำครับ


** Ban IP **
plesk bin ip_ban --ban 157.245.197.95,recidive




นี่คือชุดคำสั่ง **"สูตรสำเร็จ"** สำหรับตรวจสอบเว็บไซต์ **`aromaandmore.com`** โดยเฉพาะครับ

ผมคัดมาให้ครอบคลุมทั้ง **การเฝ้าระวังภัย (Security)** และ **การดูคนเข้าเว็บ (Traffic)** คุณสามารถ Copy ไปวางใน Terminal ได้เลยครับ

---

### 1. 📺 เฝ้าหน้าจอแบบ Real-time (ดูกล้องวงจรปิด)

ใช้ดูว่าใครกำลังทำอะไรกับเว็บอยู่ **ณ วินาทีนี้** (กด `Ctrl + C` เพื่อหยุด)

**ดู Traffic คนเข้าเว็บ (Access Log):**

```bash
tail -f /var/www/vhosts/system/aromaandmore.com/logs/access_ssl_log

```

**ดู Error และการบล็อกของ Firewall (Error Log):**
*(หน้านี้สำคัญมาก เอาไว้ดูว่า ModSecurity บล็อกใครไปบ้าง)*

```bash
tail -f /var/www/vhosts/system/aromaandmore.com/logs/error_log

```

---

### 2. 🚨 ตรวจจับการโจมตี (Security Check)

**หา IP ที่โดน Firewall (ModSecurity) บล็อกไปเมื่อกี้:**
ใช้เช็คว่ามีใครพยายามยิง SQL Injection หรือเจาะระบบแล้วโดนบล็อกไหม

```bash
grep "ModSecurity: Access denied" /var/www/vhosts/system/aromaandmore.com/logs/error_log | tail -n 20

```

**หาคนพยายามยิง SQL Injection (ดูเฉพาะคำสั่งอันตราย):**
*(เช็คย้อนหลังว่ามีใครยิงคำสั่ง `SELECT`, `UNION` เข้ามาอีกไหม)*

```bash
grep -iE "SELECT|UNION|waitfor delay" /var/www/vhosts/system/aromaandmore.com/logs/access_ssl_log | tail -n 20

```

**หาคนพยายามเจาะหน้า Admin หรือ Login:**

```bash
grep "POST " /var/www/vhosts/system/aromaandmore.com/logs/access_ssl_log | grep -E "admin|login" | tail -n 20

```

---

### 3. 📊 วิเคราะห์ Traffic (Statistics)

**🏆 10 อันดับ IP ที่เข้าเว็บเยอะที่สุด (หาตัวป่วน/Bot):**
ใช้ดูว่าใครเข้ามาเยอะผิดปกติ จะได้บล็อกถูกตัว

```bash
awk '{print $1}' /var/www/vhosts/system/aromaandmore.com/logs/access_ssl_log | sort | uniq -c | sort -nr | head -n 10

```

**🤖 ดู User-Agent (ใครเป็นคนหรือบอท):**
ใช้ดูว่า Traffic ส่วนใหญ่มาจาก Chrome, iPhone หรือ Bot ตัวไหน (เช่น MJ12bot)

```bash
awk -F\" '{print $6}' /var/www/vhosts/system/aromaandmore.com/logs/access_ssl_log | sort | uniq -c | sort -nr | head -n 20

```

**❌ ดู Link เสีย หรือการสุ่มหาไฟล์ (404 Not Found):**

```bash
grep " 404 " /var/www/vhosts/system/aromaandmore.com/logs/access_ssl_log | tail -n 20

```

---

### 4. 💡 กรณีพิเศษ (ถ้า Log Apache เงียบ)

ถ้าเช็ค `access_ssl_log` แล้วข้อมูลน้อยผิดปกติ ให้ลองเช็คที่ **Nginx Proxy Log** แทนครับ (เหมือนเคส pakkretcity):

```bash
tail -n 20 /var/www/vhosts/system/aromaandmore.com/logs/proxy_access_ssl_log

```

**คำแนะนำ:** เริ่มจากคำสั่ง **ข้อ 1 (tail -f)** เพื่อดูภาพรวมก่อน แล้วค่อยใช้ **ข้อ 3 (Top IP)** เพื่อจับตัวการครับ! 🕵️‍♂️