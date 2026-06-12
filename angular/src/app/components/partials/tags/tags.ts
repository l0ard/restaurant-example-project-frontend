import { Component, inject } from '@angular/core';
import { FoodService } from '../../../services/food/food-service';
import { RouterLink, RouterLinkActive } from '@angular/router';
import { toSignal } from '@angular/core/rxjs-interop';

@Component({
  selector: 'app-tags',
  imports: [RouterLink, RouterLinkActive],
  templateUrl: './tags.html',
  styleUrl: './tags.scss',
})
export class Tags {
  foodService = inject(FoodService);

  tags = toSignal(this.foodService.getAllTags(), { initialValue: [] });
}
