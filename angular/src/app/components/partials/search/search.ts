import { Component, inject } from '@angular/core';
import { ActivatedRoute, Router } from '@angular/router';

@Component({
  selector: 'app-search',
  imports: [],
  templateUrl: './search.html',
  styleUrl: './search.scss',
})
export class Search {
  searchTerm = '';
  private activatedRoute = inject(ActivatedRoute);
  private router = inject(Router);

  ngOnInit() {
    const url = this.router.url;

    if (url.startsWith('/search/')) {
      this.searchTerm = decodeURIComponent(url.replace('/search/', ''));
    }
  }

  search(term:string) {
    if(term){
      void this.router.navigateByUrl('/search/'+ term);
    }
  }
}
