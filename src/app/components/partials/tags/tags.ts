import { Component, inject } from '@angular/core';
import { Tag } from '../../../shared/models/Tag';
import { FoodService } from '../../../services/food/food-service';
import { RouterLink } from '@angular/router';

@Component({
  selector: 'app-tags',
  imports: [RouterLink],
  templateUrl: './tags.html',
  styleUrl: './tags.scss',
})
export class Tags {
  foodService = inject(FoodService);
  tags?: Tag[];

  ngOnInit() {
    this.tags = this.foodService.getAllTags();
  }
}
