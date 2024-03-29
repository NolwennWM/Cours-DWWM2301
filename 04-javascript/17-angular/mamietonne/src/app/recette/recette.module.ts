import { NgModule } from '@angular/core';
import { CommonModule } from '@angular/common';
import { ListeRecetteComponent } from './liste-recette/liste-recette.component';
import { DetailRecetteComponent } from './detail-recette/detail-recette.component';
import { BorderCardDirective } from './border-card.directive';
import { TypeColorPipe } from './type-color.pipe';
import { RouterModule, Routes } from '@angular/router';
import { RecetteService } from './recette.service';
import { FormsModule } from '@angular/forms';
import { EditRecetteComponent } from './edit-recette/edit-recette.component';
import { RecetteFormComponent } from './recette-form/recette-form.component';
import { AddRecetteComponent } from './add-recette/add-recette.component';

const recetteRoutes: Routes = 
[
  {path:"recette/add", component: AddRecetteComponent},
  {path: "recette/edit/:id", component: EditRecetteComponent},
  {path: "recettes", component: ListeRecetteComponent},
  {path: "recette/:id", component: DetailRecetteComponent}
];

@NgModule({
  declarations: [
    ListeRecetteComponent,
    DetailRecetteComponent,
    BorderCardDirective,
    TypeColorPipe,
    EditRecetteComponent,
    RecetteFormComponent,
    AddRecetteComponent
  ],
  imports: [
    CommonModule,
    FormsModule,
    RouterModule.forChild(recetteRoutes)
  ],
  providers: [RecetteService]
})
export class RecetteModule { }
