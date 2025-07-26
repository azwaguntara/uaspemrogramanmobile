import { Component } from '@angular/core';
import { HttpClient } from '@angular/common/http';

@Component({
  selector: 'app-tab4',
  templateUrl: 'tab4.page.html',
  styleUrls: ['tab4.page.scss'],
  standalone: false
})
export class Tab4Page {
  pengembalians: any[] = [];

  constructor(private http: HttpClient) {}

  ionViewWillEnter() {
    this.http.get<any[]>('https://www.rpl22.my.id/Teknik_Informatika/Azwa/api/getpengembalian.php')
      .subscribe(data => {
        this.pengembalians = data;
      });
  }
}
