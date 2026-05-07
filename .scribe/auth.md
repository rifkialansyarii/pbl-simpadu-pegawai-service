# Melakukan Authentication / Otentikasi

Untuk melakukan otentikasi, sertakan header **`Authorization`** dengan nilai **`"Bearer {JWT here}"`** pada HTTP request. 

**Noted:**
Setiap endpoint yang memerlukan otentikasi sudah menyediakan sebuah form untuk menyertakan header **`Authorization`** beserta nilai **`"Bearer {JWT here}"`**, posisi form ini berada di sebelah kanan dan pastikan kamu memanfaatkan fitur ini.

API ini menggunakan JWT, pastikan JWT yang kamu kirimkan valid. 

Kamu dapat mendapatkan JWT dengan melakukan login pada service 1 atau melakukan membuat JWT secara manual menggunakan [jwt.io](https://www.jwt.io/) pada bagian JWT encoder.