@php
    $route = 'menus_item';
@endphp

<div id="menu-item-modal-container">
    @include('admin.layout.partials.modal_menu_item', ['menu' => $menu])
</div>

@component('admin.layout.partials.locale', ['tab' => 'content'])

    @foreach ($localizations as $localization)

        <div class="locale-tab-panel {{ $loop->first ? 'locale-tab-active':'' }}" data-tab="content" data-localetab="{{$localization->alias}}">
                
            <div class="one-column">
                <div class="form-group">
                    <div class="form-label">
                        <label>
                            Pulse <span class="menu-item-create" data-url="{{route('menus_item_create')}}" data-menu="{{$menu->id}}" data-language="{{$localization->alias}}">aquí</span> para añadir un nuevo elemento al menu.
                        </label>
                    </div>
                </div>
            </div>

            @if($menu->parent_items->count() > 0)
                <div class="one-column">
                    <div class="form-group">
                        @include('admin.layout.partials.items_nestables', [
                            'language' => $localization->alias,
                            'item' => $menu->id,
                            'route' => 'menus_item_index', 
                            'order_route' => 'menus_reorder',
                            'show_route' => 'menus_item_show',
                            'delete_route' => 'menus_item_destroy',
                            'edit_class' => 'menu-item-edit',
                            'delete_class' => 'menu-item-delete'
                        ])
                    </div>
                </div>
            @endif
            
        </div>

    @endforeach

@endcomponent
            
