import { Component, inject } from '@angular/core';
import { CartService } from '../../../services/cart/cart-service';
import { CartLine } from '../../../shared/models/CartLine';
import { Title } from '../../partials/title/title';
import { CurrencyPipe, NgOptimizedImage } from '@angular/common';
import { RouterLink } from '@angular/router';
import { NotFound } from '../../partials/not-found/not-found';

@Component({
  selector: 'app-cart-page',
  imports: [Title, NgOptimizedImage, RouterLink, CurrencyPipe, NotFound],
  templateUrl: './cart-page.html',
  styleUrl: './cart-page.scss',
})
export class CartPage {
  private cartService = inject(CartService);

  cart = inject(CartService).cart;

  removeFromCart(cartLine: CartLine) {
    this.cartService.removeFromCart(cartLine.id).subscribe();
  }

  changeQuantity(cartLine: CartLine, quantityInString: string) {
    const quantity = parseInt(quantityInString);
    this.cartService.changeQuantity(cartLine.id, quantity).subscribe();
  }

  clearCart() {
    this.cartService.clearCart().subscribe();
  }
}
