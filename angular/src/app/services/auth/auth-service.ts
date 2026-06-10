import { inject, Injectable, signal } from '@angular/core';
import { User } from '../../shared/models/User'
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';

export interface LoginResponse {
  token: string;
}

@Injectable({
  providedIn: 'root',
})
export class AuthService {
  private http = inject(HttpClient);

  currentUser = signal<User | null>(null);

  isAuthenticated(): boolean {
    return this.currentUser() !== null;
  }

  login(username: string, password: string): Observable<LoginResponse> {
    return this.http.post<{token: string}>(
      '/api/login',
      {
        username,
        password
      }
    )
  }

  register(username: string, email: string, password: string){
    return this.http.post(
      '/api/register',
      {
        username,
        email,
        password
      }
    )
  }
}
