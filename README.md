﻿## WOCPFS Hotspot Authentiction
* Updating...

## Programmes links
* Putty.exe
```
http://www.chiark.greenend.org.uk/~sgtatham/putty/download.html
```
* WinSCP
```
https://winscp.net/eng/download.php 
```
## How to Install it

* เปิดโปรแกรม putty และล็อกอินด้วย root รีโมทผ่าน Secure Shell เข้าไปทำงานที่หน้าคอนโซล pfSense
* ถึงตรงนี้ให้ใส่ล็อกอินเป็น root และใส่รหัสผ่านของ root
* เมื่อเข้าสู่หน้าต่างคอนโซลให้ใส่ 8 เพื่อเข้าสู่โหมดคอมมานด์ Shell ให้ทำการสั่งโหลดไฟล็และแตกไฟล์โดย
```
fetch https://github.com/ddeshar/WOCPFS/archive/V.1.0.tar.gz
tar -zxvf WOCPFS-V.1.0.tar.gz
```
* จากนั้นให้เข้าไปในไดเรคทอรีของไฟล์ติดตั้งโดย
```
cd WOCPFS-V.1.0
```
* ก่อนจะติดตั้ง ให้แก้ไขไฟล์ install.sh โดยคลิกขวา Edit ผ่านโปรแกรม WinSCP
* ให้แก้ไขค่าของ mysql_PASSWORD='YOUR PASS' และ LAN_IP='YOUR IP' ตามภาพ แล้วบันทึกไฟล์
* กลับมาที่โปรแกรม putty เริ่มติดตั้ง WOCPFS โดยสั่ง sh install.sh ขั้นตอนนี้ pfSense Server ต้องเชื่อมเน็ต
* ระบบจะทำการแก้ไขไฟล์ตามที่ตั้งไว้ใน install.sh แล้วจะเริ่มติดตั้ง setup.sh ต่อไปโดยอตโนมัติ
* เมื่อติดตั้ง setup.sh เสร็จระบบจะรีสตาร์ทอีก 1 ครั้ง
* เมื่อเครื่องสตาร์ทมาแล้วให้เข้าหน้าจัดการ WOCPFS โดย https://YOUR_IP/admin โดย administrator รหัสผ่านเริ่มต้นคือ password ซึ่งสามารถแก้ไขรหัสผ่าน administrator ได้ในภายหลัง
* เข้าสู่หน้าหลักของระบบจัดการผู้ใช้ WOCPFS

## ความต้องการของระบบ
* PFSENSE >= 2.3.x 
* PHP >= 5.4.x
* Mysql >= 5.6.x

## License
* สามารถนำไปใช้งานได้ฟรี ไม่มีเงื่อนไข
* สามารถนำไปพัฒนาต่อยอดเป็นลิขสิทธิ์ของตัวเองได้ โดยใช้ชื่ออื่น

## Support
* Updating...

## Developer Detail
Copyright (C) 2018 Dipendra Deshar
E-Mail: jedeshar@gmail.com [Homepage:](http://www.ddeshar.com.np)

## ขอขอบคุณ
* BUU Management
* Mr.Karun  Bunkhrob.

## การสนับสนุน
สามารถสนับสนุนผู้จัดทำได้ โดยการบริจาคผ่านบัญชีธนาคาร
```
Krungthai Bank
Account Name Mr. Dipendra Deshar
Account No 229-0-56126-6
สาขาถนนมหาจักรพรรดิ์
```