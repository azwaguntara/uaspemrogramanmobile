import { Component } from '@angular/core';
import { HttpClient } from '@angular/common/http';
import { NavController, ToastController } from '@ionic/angular';

@Component({
  selector: 'app-tab3',
  templateUrl: 'tab3.page.html',
  styleUrls: ['tab3.page.scss'],
  standalone: false
})
export class Tab3Page {
  form: any = {
    nama: '',
    nim: '',
    prodi: '',
    semester: '',
    nohp: '',
    email: '',
    judul_buku: '',
    pengembalian: ''
  };

  id_buku: number = 0;
  daftarBuku: any[] = [];

  constructor(
    private http: HttpClient,
    private navCtrl: NavController,
    private toastCtrl: ToastController
  ) {}

  ionViewWillEnter() {
    this.http.get<any[]>('https://www.rpl22.my.id/Teknik_Informatika/Azwa/api/get_buku.php')
      .subscribe(res => {
        this.daftarBuku = res;
      });
  }

  onBukuSelected(event: any) {
    const selected = this.daftarBuku.find(b => b.id == event.detail.value);
    if (selected) {
      this.id_buku = selected.id;
      this.form.judul_buku = selected.judul;
    }
  }

  submit() {
    if (
      !this.form.nama || !this.form.nim || !this.form.prodi ||
      !this.form.semester || !this.form.nohp || !this.form.email ||
      !this.form.pengembalian || !this.id_buku
    ) {
      this.showToast('Semua data wajib diisi!');
      return;
    }

    const body = {
      id_buku: this.id_buku,
      ...this.form
    };

    this.http.post('https://www.rpl22.my.id/Teknik_Informatika/Azwa/api/pinjambuku.php', body)
      .subscribe(
        (res: any) => {
          if (res.status === 'success') {
            this.showToast('Peminjaman berhasil!');
            this.navCtrl.navigateBack('/tabs/tab6');
          } else {
            this.showToast('Gagal: ' + res.message);
          }
        },
        err => {
          this.showToast('Terjadi kesalahan koneksi.');
          console.error(err);
        }
      );
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
