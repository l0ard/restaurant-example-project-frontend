import { Component, inject } from '@angular/core';
import {RouterLink} from '@angular/router';
import { NgOptimizedImage } from '@angular/common';
import { StarRating} from '../../partial/star-rating/star-rating';

import { FoodService } from '../../../services/food/food-service';

@Component({
  selector: 'app-home',
  imports: [NgOptimizedImage, RouterLink, StarRating],
  templateUrl: './home.html',
  styleUrl: './home.scss',
})
export class Home {
  foods = inject(FoodService).getAll();
}
