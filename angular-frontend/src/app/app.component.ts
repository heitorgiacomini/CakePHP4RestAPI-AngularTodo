import { Component, OnInit } from '@angular/core';
import { catchError, Observable, of } from 'rxjs';
import { ApiService } from './api.service';
import { Todo } from './todo';
@Component({
  selector: 'app-root',
  templateUrl: './app.component.html',
  styleUrls: ['./app.component.scss']
})
export class AppComponent implements OnInit{
  newTodo: Todo = new Todo();
  todos$!: Observable<Todo[]>;


  constructor(private _todoService: ApiService) {
  }

  ngOnInit() {
    this.onRefresh();
  }

  addTodo() {
    this.Save(this.newTodo);
    this.newTodo.name = "";
    // this.newTodo = new Todo();
  }

  toggleTodoStatus(todo: Todo){
    todo.status = !todo.status;
    this.Save(todo);
  }

  Save(todo: Todo){
    console.log(todo);
    this._todoService.Save(todo).subscribe(
      (success) => {
        console.log("success");
        this.onRefresh();
      },
      (error) =>
        console.log("error"),
        () => {}
    );
  }

  removeTodo(todo: Todo){
    console.log(todo);

    this._todoService.deleteTodoById(todo.id).subscribe((data)=>{
      console.log("success");
      this.onRefresh();
    });

  }

  onRefresh(){
    this.todos$ = this._todoService.getAllTodos().pipe(
      catchError((error) => {
        // this.error$.next(true);
        this.handleError();
        return of();
      })
    );

  }

  handleError() {
    console.log("EROU");
  }

}








      // this._modalService.showAlert(
      //   'Erro ao carregar cursos. Tente novamente mais tarde.',
      //   'danger'
      // );

    // get todos() {
    //   // return this._todoService.getAllTodos();
    // }
