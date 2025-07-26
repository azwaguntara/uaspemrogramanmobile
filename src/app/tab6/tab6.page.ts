import { Component } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { ToastController } from '@ionic/angular';

@Component({
  selector: 'app-tab6',
  templateUrl: 'tab6.page.html',
  styleUrls: ['tab6.page.scss'],
  standalone: false
})
export class Tab6Page {
  peminjaman: any[] = [];

  constructor(
    private http: HttpClient,
    private toastCtrl: ToastController
  ) {}

  ionViewWillEnter() {
    this.loadData();
  }

  loadData() {
    this.http.get<any[]>('https://www.rpl22.my.id/Teknik_Informatika/Azwa/api/getpeminjaman.php')
      .subscribe({
        next: data => {
          this.peminjaman = data;
        },
        error: err => {
          this.showToast('Gagal memuat data peminjaman');
          console.error('Load error:', err);
        }
      });
  }

  kembalikan(buku: any) {
  const headers = { 'Content-Type': 'application/json' };
  const body = JSON.stringify({
    id: buku.id,
    id_buku: buku.id_buku
  });

  this.http.post('https://www.rpl22.my.id/Teknik_Informatika/Azwa/api/kembalikan_buku.php', body, { headers })
    .subscribe({
      next: (res: any) => {
        if (res.status === 'success') {
          this.showToast('Buku berhasil dikembalikan!');
          this.loadData();
        } else {
          this.showToast('Gagal mengembalikan buku: ' + res.message);
          console.error('Kembalikan error:', res);
        }
      },
      error: err => {
        this.showToast('Terjadi kesalahan koneksi.');
        console.error('HTTP Error:', err);
      }
    });
}

  async showToast(msg: string) {
    const toast = await this.toastCtrl.create({
      message: msg,
      duration: 2000,
      position: 'bottom'
    });
    toast.present();
  }
}
