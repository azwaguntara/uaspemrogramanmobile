import { Component } from '@angular/core';
import { ApiService } from '../services/api.service';

@Component({
  selector: 'app-tab2',
  templateUrl: 'tab2.page.html',
  styleUrls: ['tab2.page.scss'],
  standalone: false,
})
export class Tab2Page {
  daftarBuku: any[] = [];

  constructor(private api: ApiService) {}

  ionViewWillEnter() {
    this.loadBuku();
  }

  loadBuku() {
    this.api.getBuku().subscribe(res => {
      if (res.status === 'success') {
        this.daftarBuku = res.data;
      }
    }, error => {
      console.error('Gagal mengambil data buku:', error);
    });
  }
}
