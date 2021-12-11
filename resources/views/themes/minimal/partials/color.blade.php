@push('script')
    <script>
        var root = document.querySelector(':root');
        root.style.setProperty('--background-color', '{{config('color.background_color')??'#ffffff'}}');
        root.style.setProperty('--background-color-alt', '{{config('color.secondary_background_color')??'#f2f5f7'}}');
        root.style.setProperty('--brand-color', '{{config('color.base_color')??'#1fd3c6'}}');
        root.style.setProperty('--brand-color-alt', '{{config('color.secondary_color')??'#385081'}}');
        root.style.setProperty('--title-color', '{{config('color.title_color') ??'#37517e'}}');
        root.style.setProperty('--text-color', '{{config('color.text_color') ??'#2e4369'}}');
        root.style.setProperty('--natural-color', '{{config('color.natural_color') ??'#ffffff'}}');
        root.style.setProperty('--error', '{{config('color.error_color') ??'#f21a29'}}');
        root.style.setProperty('--brand-color-alt-dark', '{{config('color.secondary_alternative_color')??'#022c63'}}');
        root.style.setProperty('--brand-color-light', '{{config('color.background_alternative_color')??'#e6f9f8'}}');
        root.style.setProperty('--border-color', '{{config('color.border_color')??'#e7e5e5'}}');
    </script>
@endpush
