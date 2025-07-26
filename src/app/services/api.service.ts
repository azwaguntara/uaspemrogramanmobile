import { Injectable } from '@angular/core';
import { HttpClient, HttpHeaders } from '@angular/common/http';
import { Observable } from 'rxjs';

@Injectable({
  providedIn: 'root'
})
export class ApiService {
  private apiUrl = 'https://www.rpl22.my.id/Teknik_Informatika/Azwa/api/'; 
  constructor(private http: HttpClient) {}

  getBuku(): Observable<any> {
    return this.http.get(`${this.apiUrl}/ambilbuku.php`);
  }

  simpanBuku(data: any): Observable<any> {
    return this.http.post(`${this.apiUrl}/simpanbuku.php`, data);
  }

  pinjamBuku(data: any): Observable<any> {
    return this.http.post(`${this.apiUrl}/pinjambuku.php`, data);
  }


  getPengembalian(): Observable<any> {
    return this.http.get(`${this.apiUrl}/getpengembalian.php`);
  }

  kembalikanBuku(data: any): Observable<any> {
    const headers = new HttpHeaders({ 'Content-Type': 'application/json' });
    return this.http.post(`${this.apiUrl}/kembalikan_buku.php`, JSON.stringify(data), { headers });
  }
}
