import { Food } from './Food';

export class CartLine {
  id!: number;
  food!: Food;
  quantity!: number;
  linePrice!: number;

  // constructor(public food: Food) {
  //   this.price = food.price;
  // }
}
