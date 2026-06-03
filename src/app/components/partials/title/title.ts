import { Component, input, Input } from '@angular/core';
import { NgStyle } from '@angular/common';

@Component({
  selector: 'app-title',
  imports: [NgStyle],
  templateUrl: './title.html',
  styleUrl: './title.scss',
})
export class Title {
  title = input.required<string>();
  margin = input<string>('1rem 0 1rem 0.2rem');
  fontSize = input<string>('1.7rem');
}
