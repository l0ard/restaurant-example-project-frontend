import { Component, input } from '@angular/core';

@Component({
  selector: 'app-star-rating',
  imports: [],
  templateUrl: './star-rating.html',
  styleUrl: './star-rating.scss',
  standalone: true,
})
export class StarRating {
  readonly maxStars = 5;
  rating = input(0);
  protected readonly Math = Math;

  get stars() {
    return Array(this.maxStars);
  }
}
