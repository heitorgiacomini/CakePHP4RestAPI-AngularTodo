import { Injectable } from '@angular/core';
import { environment } from 'src/environments/environment';
import { HttpClient } from '@angular/common/http';
import { Todo } from './todo';
import { delay, Observable, take, tap } from 'rxjs';


@Injectable({
  providedIn: 'root',
})
export class ApiService {
  private readonly API = `${environment.apiUrl}`;
  constructor(private _http: HttpClient) {}

  public getAllTodos(): Observable<Todo[]> {
    return this._http.get<Todo[]>(`${this.API}list-todo.json`)
    .pipe(
      tap(console.log),
      delay(600),
    );
  }

  deleteTodoById(id:number){
    var url = `${this.API}delete-todo/${id}.json`;
    console.log(url);

    return this._http.delete(url)
    .pipe(
      tap(console.log)
      // take(1)
    );
  }

  Update(todo: Todo) {
    var url = `${this.API}update-todo/${todo.id}.json`;
    return this._http.post(url, todo)
    .pipe(
      take(1)
    );
  }

  Create(todo: Todo) {
    var url = `${this.API}add-todo.json`;
    return this._http.post(url, todo)
    .pipe(
      take(1)
    );
  }

  Save(todo: Todo){
    if(todo.id){
      return this.Update(todo);
    }
    return this.Create(todo);
  }

}
