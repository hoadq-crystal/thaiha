<?php

namespace Sebastienheyd\Boilerplate\Datatables\Admin;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Auth;
use Sebastienheyd\Boilerplate\Datatables\Button;
use Sebastienheyd\Boilerplate\Datatables\Column;
use Sebastienheyd\Boilerplate\Datatables\Datatable;

class ContactDatatable extends Datatable
{
    public $slug = 'contacts';

    public function datasource()
    {
        return \DB::table('contact_messages')->select([
            'id',
            'name',
            'phone',
            'email',
            'address',
            'content',
            'created_at',
            'updated_at'
        ]);
    }

    public function columns(): array
    {
        return [
            Column::add(__('id'))
                ->width('12%')
                ->data('id'),

            Column::add(__('Name'))
                ->width('12%')
                ->data('name'),

            Column::add(__('Phone'))
                ->width('12%')
                ->data('phone'),

            Column::add(__('Email'))
                ->width('12%')
                ->data('email', function($contact){
                return html_entity_decode($contact->email);
            }),

            Column::add(__('Address'))
                ->width('12%')
                ->data('address', function($contact) {
                    return html_entity_decode($contact->address);
                }),

            Column::add(__('Content'))
                ->width('12%')
                ->data('content', function($contact) {
                    return html_entity_decode($contact->content);
                }),

            Column::add(__('Created at'))
                ->width('12%')
                ->data('created_at')
                ->name('created_at')
                ->dateFormat(),

            Column::add(__('Updated at'))
                ->width('12%')
                ->data('updated_at')
                ->name('updated_at')
                ->dateFormat(),

            Column::add(__(''))
                ->width('70px')
                ->actions(function ($contact) {

                    $buttons = Button::edit('boilerplate.contacts.edit', $contact->id);

                    $buttons .= Button::delete('boilerplate.contacts.destroy', $contact->id);

                    return $buttons;
                }),
        ];
    }
}
