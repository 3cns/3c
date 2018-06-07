import { CommonModule } from '@angular/common';

import { NgModule } from '@angular/core';
import { FormsModule } from "@angular/forms";
import { TextMaskModule } from 'angular2-text-mask'
// import {DpDatePickerModule} from 'ng2-date-picker';
import { WidgetRoutingModule } from './widget-routing.module';
import { ListWidgetComponent } from './list-widget/list-widget.component';
import { CreateWidgetComponent } from './create-widget/create-widget.component';
import { SharedModule } from '../../../shared/shared.module';

@NgModule({
  imports: [
      CommonModule,

      WidgetRoutingModule,
      FormsModule,
      TextMaskModule,
      SharedModule
  ],
  declarations: [
    CreateWidgetComponent,
    ListWidgetComponent,
  ]
})
export class WidgetModule { }
