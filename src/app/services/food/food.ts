import { Injectable } from '@angular/core';
import { FoodImage } from '../../models/food-image';

@Injectable({
  providedIn: 'root',
})
export class Food {
  getAll(): FoodImage[] {
    let result: FoodImage[] = [];

    for (let i = 1; i < 7; i++) {
      result.push({
        path: 'assets/images/foods/food-' + i + '.jpg',
        name: 'Food ' + i,
      });
    }

    return result;
  }
}
