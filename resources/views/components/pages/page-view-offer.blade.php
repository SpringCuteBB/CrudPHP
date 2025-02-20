<div class="flex flex-col pt-[3rem] px-5 xl:px-20 md:px-10 mb-14">
    <div class="flex items-center gap-3 mb-4">
        <h1 class="roboto-condensed font-bold text-5xl mb-4">
            Offer {{ $offer->id }}
        </h1>
        <x-svgs.export-svg />
    </div>
    <p class="font-bold text-xl mb-2">Created by: <span class="text-[#FE136D]"> {{ $offer->usuario }}</span></p>
    <div class="flex flex-col w-[100%] xl:w-[75%] 2xl:w-[50%]">
        <div class="grid grid-cols-2 gap-4">
            <div class="flex flex-col col-span-2">
                <label for="titulo" class="text-sm">Title:</label>
                <p class="border py-2 px-2 border-gray-900 rounded-md">
                    {{ $offer->titulo }}
                </p>
            </div>
            <div class="flex flex-col col-span-2">
                <label for="descripcion" class="text-sm">Description:</label>
                <p class="resize-none border py-2 px-2 border-gray-900 rounded-md h-[84px]">
                    {{ $offer->descripcion }}
                </p>
            </div>
            <div class="flex flex-col" id="tipoOfertaContainer">
                <label for="tipo_oferta" class="text-sm">Offer Type:</label>
                <p class="border py-2 px-2 border-gray-900 rounded-md" id="tipo_oferta">
                    {{ $offer->tipo_oferta }}
                </p>
            </div>
            <div class="flex flex-col" style="visibility: hidden" id="codigoCuponContainer">
                <label for="codigo_cupon" class="text-sm">Coupon Code:</label>
                <p class="border py-2 px-2 border-gray-900 rounded-md">
                    {{ $offer->codigo_cupon }}
                </p>
            </div>
            <div class="flex flex-col">
                <label for="cadena" class="text-sm">Chain:</label>
                <p class="border py-2 px-2 border-gray-900 rounded-md">
                    {{ $offer->cadena }}
                </p>
            </div>
            <div class="flex flex-col">
                <label for="provincia" class="text-sm">Province:</label>
                <p class="border py-2 px-2 border-gray-900 rounded-md">
                    {{ $offer->provincia }}
                </p>
            </div>
            <div class="flex flex-col">
                <label for="fecha_inicio" class="text-sm">Start Date:</label>
                <p class="border py-2 px-2 border-gray-900 rounded-md">
                    {{ $offer->fecha_inicio }}
                </p>
            </div>
            <div class="flex flex-col">
                <label for="fecha_fin" class="text-sm">End Date:</label>
                <p class="border py-2 px-2 border-gray-900 rounded-md">
                    {{ $offer->fecha_fin }}
                </p>
            </div>
            <div class="flex flex-col">
                <label for="precio_original" class="text-sm">
                    Original Price:
                </label>
                <p class="border py-2 px-2 border-gray-900 rounded-md">
                    {{ $offer->precio_original }}
                </p>
                <span class="text-gray-500">(100% of the price)</span>
            </div>
            <div class="flex flex-col">
                <label for="precio_descuento" class="text-sm">
                    Discounted Price:
                </label>
                <p class="border py-2 px-2 border-gray-900 rounded-md">
                    {{ $offer->precio_descuento }}
                </p>
                @php
                    $discountPercentage =
                        (($offer->precio_original - $offer->precio_descuento) / $offer->precio_original) * 100;
                @endphp

                <span class="text-gray-500">
                    ({{ round($discountPercentage, 2) }}% of discount)
                </span>
            </div>
            <div class="flex flex-col col-span-2">
                <label for="enlace" class="text-sm">Link:</label>
                <a class="border py-2 px-2 border-gray-900 text-blue-500 hover:text-blue-700 transition-all underline rounded-md"
                    href="{{ $offer->enlace }}">
                    {{ $offer->enlace }}
                </a>
            </div>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const tipoOferta = document.getElementById('tipo_oferta');
        const codigoCuponContainer = document.getElementById('codigoCuponContainer');
        if (tipoOferta.textContent.trim() !== 'descuento') {
            codigoCuponContainer.style.visibility = 'visible';
        }
        const svgExport = document.getElementById('svgExport');
        svgExport.addEventListener("click", () => {
            const offerId = {{ $offer->id }};
            fetch(`/api/offers/${offerId}`)
                .then(response => response.json())
                .then(data => {
                    const jsonString = JSON.stringify(data, null, 2);
                    const blob = new Blob([jsonString], {
                        type: 'application/json'
                    });
                    const url = URL.createObjectURL(blob);
                    const a = document.createElement('a');
                    a.href = url;
                    a.download = `offer_${offerId}.json`;
                    document.body.appendChild(a);
                    a.click();
                    document.body.removeChild(a);
                    URL.revokeObjectURL(url);
                })
                .catch(error => {
                    console.error('Error fetching offer data:', error);
                });
        });
    });
</script>
