<div
    class="xl:col-span-10 md:col-span-8 h-12 col-span-12 bg-gray-50 border border-gray-200 border-l-0 flex items-center px-4">
    <a href="{{ route('controlPanel') }}">{{ __('Home') }}</a>
    <x-svgs.arrow-svg />
    <a href="{{ route('editOffer', ['id' => $offer->id]) }}">
        {{ __('View Offer ' . $offer->id) }}
    </a>
</div>
