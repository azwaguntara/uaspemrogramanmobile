import { Component } from '@angular/core';
import { ApiService } from '../services/api.service';
import { AlertController } from '@ionic/angular';

@Component({
  selector: 'app-tab1',
  templateUrl: 'tab1.page.html',
  styleUrls: ['tab1.page.scss'],
  standalone: false,
})
export class Tab1Page {
  judul: string = '';
  penulis: string = '';
  penerbit: string = '';
  stok: number | null = null;

  constructor(private api: ApiService, private alertCtrl: AlertController) {}

  async simpanBuku() {
    if (!this.judul || !this.penulis || !this.penerbit || !this.stok) {
      const alert = await this.alertCtrl.create({
        header: 'Validasi',
        message: 'Semua field wajib diisi.',
        buttons: ['OK']
      });
      await alert.present();
      return;
    }

    const data = {
      judul: this.judul,
      penulis: this.penulis,
      penerbit: this.penerbit,
      stok: this.stok
    };

    this.api.simpanBuku(data).subscribe(
      async res => {
        if (res && res.status === 'success') {
          const alert = await this.alertCtrl.create({
            header: 'Sukses',
            message: 'Data buku berhasil disimpan.',
            buttons: ['OK']
          });
          await alert.present();

          this.judul = '';
          this.penulis = '';
          this.penerbit = '';
          this.stok = null;
        } else {
          const alert = await this.alertCtrl.create({
            header: 'Gagal',
            message: res?.message || 'Gagal menyimpan data buku.',
            buttons: ['OK']
          });
          await alert.present();
        }
      },
      async error => {
        const alert = await this.alertCtrl.create({
          header: 'Kesalahan Server',
          message: 'Tidak dapat menyimpan data buku.',
          buttons: ['OK']
        });
        await alert.present();
        console.error('Simpan Buku Error:', error);
      }
    );
  }
}
