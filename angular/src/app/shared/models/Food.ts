import { Origin } from './Origin';
import { Tag } from './Tag';

export class Food {
  id!:number;
  name!: string;
  price!: number;
  tags?: Tag[];
  description?: string;
  favorite!: boolean;
  stars!: number;
  imageUrl!: string;
  origins!: Origin[];
  cookTime!: string;
}
