import { inject, Injectable } from '@angular/core';
import { Food } from '../../shared/models/Food';
import { HttpClient } from '@angular/common/http';
import { Observable } from 'rxjs';
import { Tag } from '../../shared/models/Tag';
import { Origin } from '../../shared/models/Origin';

@Injectable({
  providedIn: 'root',
})
export class FoodService {
  private http = inject(HttpClient);
  private readonly apiUrl = '/api/';

  getAll(): Observable<Food[]> {
    return this.http.get<Food[]>(this.apiUrl + 'foods');
  }

  getAllFoodsBySearchTerm(searchTerm: string) {
    return this.http.get<Food[]>(this.apiUrl + 'foods/search/' + encodeURIComponent(searchTerm));
  }

  getAllFoodsByTag(tagId: number): Observable<Food[]> {
    return this.http.get<Food[]>(this.apiUrl + 'foods/tag/' + tagId);
  }

  getFoodById(foodId: number): Observable<Food> {
    return this.http.get<Food>(this.apiUrl + 'foods/' + foodId);
  }

  getAllTags() {
    return this.http.get<Tag[]>(this.apiUrl + 'tags');
  }

  getAllOrigins() {
    return this.http.get<Origin[]>(this.apiUrl + 'origins');
  }
}
