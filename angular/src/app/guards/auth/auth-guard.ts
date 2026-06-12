import { CanActivateFn, Router } from '@angular/router';
import { inject } from '@angular/core';

export const authGuard: CanActivateFn = (route, state) => {
  const router = inject(Router);

  //Todo replace with real signal-based backend auth-Check. Token could be expired
  const token = localStorage.getItem('jwt');

  if (token){
    return true;
  }
  router.navigate(['/login']);
  return false;
};
