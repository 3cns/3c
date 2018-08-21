import { Component, OnDestroy, OnInit } from '@angular/core';
import { Store } from '@ngrx/store';
import * as fromAfterLogin from '../../../store/after-login.reducers';
import { Observable } from 'rxjs/Observable';
import * as DepartmentActions from '../../../store/department/department.actions';
import { Router } from '@angular/router';
import { Subscription } from 'rxjs/Subscription';

@Component({
  selector: 'app-list-department',
  templateUrl: './list-department.component.html',
  styleUrls: ['./list-department.component.css']
})
export class ListDepartmentComponent implements OnInit, OnDestroy {

  /** Variable declaration */
  afterLoginState: Observable<fromAfterLogin.FeatureState>;
  authSubscription: Subscription;
    order = 'info.name';
    sortedCollection: any[];
    page: number;
    term: any;
    companySearch: any;
    companyList: any[];
    companySubscription: Subscription;
  constructor(private store: Store<fromAfterLogin.AfterLoginFeatureState>,
              private router: Router) { }

  /** Function to be executed when component initializes */
  ngOnInit() {
      this.page = 1;
      this.companySearch = '';
      this.authSubscription = this.store.select('auth')
      .subscribe(
        (data) => {
          if (data.isAdmin) {
            this.store.dispatch(new DepartmentActions.GetDepartmentListAttempt({userId: data.userId}));
          } else {
            this.store.dispatch(new DepartmentActions.GetDepartmentListAttempt({}));
          }
        }
      );

    this.afterLoginState = this.store.select('afterLogin');
    this.companySubscription = this.store.select('afterLogin')
      .subscribe(
        (data) => {
          this.companyList = data.department.list.map(item => item.company_name)
            .filter((value, index, self) => self.indexOf(value) === index && value !== null && value !== '');
        }
      );
  }

  /** Function call to start editing a department */
  onEdit(depId: number) {
    this.router.navigate([ 'department/edit/', depId ]);
  }

  ngOnDestroy (): void {
    this.authSubscription.unsubscribe();
  }

}