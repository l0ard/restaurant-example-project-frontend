import { Component, inject, signal } from '@angular/core';
import { RouterOutlet } from '@angular/router';
import { Header } from './components/partials/header/header';
import { CartService } from './services/cart/cart-service';

@Component({
  selector: 'app-root',
  imports: [RouterOutlet, Header],
  templateUrl: './app.html',
  styleUrl: './app.scss',
})
export class App {
  private cartService = inject(CartService);
  protected readonly title = signal('restaurant-example-project');
  ngOnInit() {
    this.cartService.loadCart().subscribe();
  }
}
