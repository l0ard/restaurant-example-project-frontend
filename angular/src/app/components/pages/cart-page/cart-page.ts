import { Component, inject } from '@angular/core';
import { Cart } from '../../../shared/models/Cart';
import { CartService } from '../../../services/cart/cart-service';
import { CartItem } from '../../../shared/models/CartItem';
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

  cart!: Cart;
  ngOnInit() {
    this.cartService.getCartObservable().subscribe((cart) => {
      this.cart = cart;
    });
  }

  removeFromCart(cartItem: CartItem) {
    this.cartService.removeFromCart(cartItem.food.id);
  }

  changeQuantity(cartItem: CartItem, quantityInString: string) {
    const quantity = parseInt(quantityInString);
    this.cartService.changeQuantity(cartItem.food.id, quantity);
  }
}
