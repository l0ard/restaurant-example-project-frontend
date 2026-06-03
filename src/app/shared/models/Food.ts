export class Food {
  id!:string;
  name!: string;
  price!: number;
  tags?: string[];
  description?: string;
  favorite!: boolean;
  stars!: number;
  imageUrl!: string;
  origins!: string[];
  cookTime!: string;
}
