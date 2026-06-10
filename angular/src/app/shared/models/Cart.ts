import { CartLine } from './CartLine';

export class Cart {
  id!: number;
  cartLines!: CartLine[];
  totalPrice!: number;
  totalCount!: number;
}
