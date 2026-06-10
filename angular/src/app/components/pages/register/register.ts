import { Component, inject } from '@angular/core';
import { AuthService } from '../../../services/auth/auth-service';
import { Router, RouterLink } from '@angular/router';
import { FormBuilder, ReactiveFormsModule, Validators } from '@angular/forms';
import { finalize } from 'rxjs';

@Component({
  selector: 'app-register',
  imports: [ReactiveFormsModule, RouterLink],
  templateUrl: './register.html',
  styleUrl: './register.scss',
})
export class Register {
  private authService = inject(AuthService);
  private router = inject(Router);
  private fb = inject(FormBuilder);

  loading = false;
  error: string | null = null;

  form = this.fb.nonNullable.group({
    username: ['', [Validators.required]],
    email: ['', [Validators.required, Validators.email]],
    password: ['', [Validators.required, Validators.minLength(8)]],
  });

  register(): void {
    if (this.form.valid) {
      this.form.markAllAsTouched();
      return;
    }

    this.loading = true;
    this.error = null;

    this.authService
      .register(
        this.form.controls.username.value,
        this.form.controls.email.value,
        this.form.controls.password.value,
      )
      .pipe(finalize(() => {this.loading = false;}))
      .subscribe({
        next: () => {
          this.router.navigate(['/login']);
        },
        error: (error) => {

          this.error = error?.error?.message ?? 'Registration failed';
        },
      });
  }
}
