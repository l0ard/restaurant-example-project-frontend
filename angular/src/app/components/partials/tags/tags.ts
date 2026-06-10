import { Component, inject } from '@angular/core';
import { FoodService } from '../../../services/food/food-service';
import { RouterLink } from '@angular/router';
import { toSignal } from '@angular/core/rxjs-interop';

@Component({
  selector: 'app-tags',
  imports: [RouterLink],
  templateUrl: './tags.html',
  styleUrl: './tags.scss',
})
export class Tags {
  foodService = inject(FoodService);

  tags = toSignal(this.foodService.getAllTags(), { initialValue: [] });
}
