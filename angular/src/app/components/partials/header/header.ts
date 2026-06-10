import { Component, inject } from '@angular/core';
import { RouterLink } from '@angular/router';
import { UpperCasePipe } from '@angular/common';
import { CartService } from '../../../services/cart/cart-service';

@Component({
  selector: 'app-header',
  imports: [RouterLink, UpperCasePipe],
  templateUrl: './header.html',
  styleUrl: './header.scss',
})
export class Header {
  cart = inject(CartService).cart;
}
