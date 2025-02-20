<div class="flex flex-col pt-[3rem] px-5 xl:px-20 md:px-10">
    <div class="flex items-center gap-3 mb-4">
        <h1 class="roboto-condensed font-bold text-5xl mb-4">
            Offer {{ $offer->id }}
        </h1>
        <x-svgs.export-svg />
    </div>
    <div class="flex flex-col w-[100%] xl:w-[75%] 2xl:w-[50%]">
        <form id="updateOfferForm">
            @csrf
            <div class="grid grid-cols-2 gap-4">
                <div class="flex flex-col col-span-2">
                    <label for="titulo" class="text-sm">Title:</label>
                    <input type="text" name="titulo" id="titulo"
                        class="border py-4 px-2 border-gray-900 h-[1.7rem] rounded-md" value="{{ $offer->titulo }}" />
                    <span id="tituloError" class="text-red-500 text-sm"></span>
                </div>
                <div class="flex flex-col col-span-2">
                    <label for="descripcion" class="text-sm">
                        Description:
                    </label>
                    <textarea name="descripcion" id="descripcion" rows="4"
                        class="resize-none border py-2 px-2 border-gray-900 rounded-md" style="resize: none">
{{ $offer->descripcion }}</textarea>
                    <span id="descripcionError" class="text-red-500 text-sm"></span>
                </div>
                <div class="flex flex-col">
                    <label for="tipo_oferta" class="text-sm">Offer Type:</label>
                    <select name="tipo_oferta" id="tipo_oferta" class="border h-[34px] border-gray-900 rounded-md">
                        <option value="cupon" {{ $offer->tipo_oferta == 'cupon' ? 'selected' : '' }}>Coupon</option>
                        <option value="descuento" {{ $offer->tipo_oferta == 'descuento' ? 'selected' : '' }}>Discount
                        </option>
                    </select>
                    <span id="tipoOfertaError" class="text-red-500 text-sm"></span>
                </div>
                <div class="flex flex-col" style="visibility: hidden" id="codigoCuponContainer">
                    <label for="codigo_cupon" class="text-sm">
                        Coupon Code:
                    </label>
                    <input type="text" name="codigo_cupon" id="codigo_cupon" value="{{ $offer->codigo_cupon }}"
                        class="border py-4 px-2 border-gray-900 h-[1.7rem] rounded-md" />
                    <span id="codigoCuponError" class="text-red-500 text-sm"></span>
                </div>
                <div class="flex flex-col">
                    <label for="cadena" class="text-sm">Chain:</label>
                    <input type="text" value="{{ $offer->cadena }}" name="cadena" id="cadena"
                        class="border py-4 px-2 border-gray-900 h-[1.7rem] rounded-md" />
                    <span id="cadenaError" class="text-red-500 text-sm"></span>
                </div>
                <div class="flex flex-col">
                    <label for="provincia" class="text-sm">Province:</label>
                    <input type="text" value="{{ $offer->provincia }}" name="provincia" id="provincia"
                        class="border py-4 px-2 border-gray-900 h-[1.7rem] rounded-md" />
                    <span id="provinciaError" class="text-red-500 text-sm"></span>
                </div>
                <div class="flex flex-col">
                    <label for="fecha_inicio" class="text-sm">
                        Start Date:
                    </label>
                    <input type="date" name="fecha_inicio" value="{{ $offer->fecha_inicio }}" id="fecha_inicio"
                        class="border py-4 px-2 border-gray-900 h-[1.7rem] rounded-md" />
                    <span id="fechaInicioError" class="text-red-500 text-sm"></span>
                </div>
                <div class="flex flex-col">
                    <label for="fecha_fin" class="text-sm">End Date:</label>
                    <input type="date" value="{{ $offer->fecha_fin }}" name="fecha_fin" id="fecha_fin"
                        class="border py-4 px-2 border-gray-900 h-[1.7rem] rounded-md" />
                    <span id="fechaFinError" class="text-red-500 text-sm"></span>
                </div>
                <div class="flex flex-col">
                    <label for="precio_original" class="text-sm">
                        Original Price:
                    </label>
                    <input type="number" step="0.01" value="{{ $offer->precio_original }}" name="precio_original"
                        id="precio_original" class="border py-4 px-2 border-gray-900 h-[1.7rem] rounded-md" />
                    <span id="precioOriginalError" class="text-red-500 text-sm"></span>
                </div>
                <div class="flex flex-col">
                    <label for="precio_descuento" class="text-sm">
                        Discounted Price:
                    </label>
                    <input type="number" step="0.01" value="{{ $offer->precio_descuento }}"
                        name="precio_descuento" id="precio_descuento"
                        class="border py-4 px-2 border-gray-900 h-[1.7rem] rounded-md" />
                    <span id="precioDescuentoError" class="text-red-500 text-sm"></span>
                </div>
                <div class="flex flex-col col-span-2">
                    <label for="enlace" class="text-sm">Link:</label>
                    <input type="url" name="enlace" id="enlace" value="{{ $offer->enlace }}"
                        class="border py-4 px-2 border-gray-900 h-[1.7rem] rounded-md" />
                    <span id="enlaceError" class="text-red-500 text-sm"></span>
                </div>
            </div>
            <div class="w-full mt-4 grid grid-cols-2 items-center gap-2">
                <div class="flex items-center gap-2">
                    <button type="submit" id="updateOfferButton"
                        class="bg-blue-900 py-2 px-4 w-[128px] h-[40px] rounded-md text-white font-bold hover:cursor-pointer hover:bg-blue-800 transition-all mb-5">
                        Update Offer
                    </button>
                    <p class="text-gray-400 font-bold hidden" id="submited-p">
                        Offer updated!
                    </p>
                </div>
                <div class="flex items-center justify-end gap-2">
                    <div class="items-center gap-2 hidden" id="deleteContainer">
                        <label for="delete" class="hover:cursor-pointer select-none">
                            Check to confirm.
                        </label>
                        <input type="checkbox" name="delete" id="delete"
                            class="border-gray-500 hover:border-red-900" />
                    </div>
                    <button type="submit" id="deleteOfferButton"
                        class="bg-red-900 py-2 px-4 w-[128px] h-[40px] rounded-md text-white font-bold hover:cursor-pointer hover:bg-red-800 transition-all mb-5">
                        Delete Offer
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const updateOfferForm = document.getElementById('updateOfferForm');
        const tipoOferta = document.getElementById('tipo_oferta');
        const codigoCuponContainer = document.getElementById(
            'codigoCuponContainer',
        );
        const codigoCupon = document.getElementById('codigo_cupon');

        tipoOferta.addEventListener('change', () => {
            if (tipoOferta.value === 'cupon') {
                codigoCuponContainer.style.visibility = 'visible';
                codigoCupon.value = '';
            } else {
                codigoCuponContainer.style.visibility = 'hidden';
                codigoCupon.value = 'No cupon';
            }
        });

        //svg export
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

        if (codigoCupon.value === 'No cupon') {
            codigoCuponContainer.style.visibility = 'hidden';
        }

        let firstTimeClicked = true;
        document
            .getElementById('deleteOfferButton')
            .addEventListener('click', async (e) => {
                try {
                    e.preventDefault();
                    if (firstTimeClicked) {
                        document
                            .getElementById('deleteContainer')
                            .classList.remove('hidden');
                        firstTimeClicked = false;
                        return;
                    }
                    if (document.getElementById('delete').checked) {
                        const response = await fetch('/offers/{{ $offer->id }}', {
                            method: 'DELETE',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': document
                                    .querySelector('meta[name="csrf-token"]')
                                    .getAttribute('content'),
                            },
                            credentials: 'same-origin',
                        });
                        if (response.ok) {
                            if (response.ok) {
                                window.location.href = '/';
                            } else {
                                console.error('Failed to delete offer');
                            }
                        } else {
                            console.error('Failed to delete offer');
                        }
                    }
                } catch (e) {
                    console.log(e);
                }

            });

        updateOfferForm.addEventListener('submit', async (e) => {
            let isValid = true;

            document
                .querySelectorAll('.text-red-500')
                .forEach((el) => (el.textContent = ''));

            // Title
            const titulo = document.getElementById('titulo').value;
            if (titulo.length === 0 || titulo.length > 75) {
                document.getElementById('tituloError').textContent =
                    'Title must be between 1 and 75 characters.';
                isValid = false;
            }

            // Description
            const descripcion = document.getElementById('descripcion').value;
            if (descripcion.length === 0 || descripcion.length > 150) {
                document.getElementById('descripcionError').textContent =
                    'Description must be between 1 and 150 characters.';
                isValid = false;
            }

            // Offer type
            if (
                tipoOferta.value !== 'descuento' &&
                tipoOferta.value !== 'cupon'
            ) {
                document.getElementById('tipoOfertaError').textContent =
                    "Offer type must be either 'Discount' or 'Coupon'.";
                isValid = false;
            }

            // Coupon code
            if (
                tipoOferta.value === 'cupon' &&
                (codigoCupon.value.length > 11 || codigoCupon.value.length <= 0)
            ) {
                document.getElementById('codigoCuponError').textContent =
                    'Coupon code must be 11 characters or less.';
                isValid = false;
            }

            // Chain
            const cadena = document.getElementById('cadena').value;
            if (cadena.length > 50 || cadena.length <= 0) {
                document.getElementById('cadenaError').textContent =
                    'Chain must be between 1 and 50 characters.';
                isValid = false;
            }

            // Province
            const provincia = document.getElementById('provincia').value;
            if (
                provincia.length > 75 ||
                /\d/.test(provincia) ||
                provincia.length <= 0
            ) {
                document.getElementById('provinciaError').textContent =
                    'Province must be between 1 and 75 characters and contain no numbers.';
                isValid = false;
            }

            // Date
            const normalize = (date) => {
                return new Date(
                    date.getFullYear(),
                    date.getMonth(),
                    date.getDate(),
                );
            };

            const fechaInicio = normalize(
                new Date(document.getElementById('fecha_inicio').value),
            );
            const fechaFin = normalize(
                new Date(document.getElementById('fecha_fin').value),
            );
            const today = normalize(new Date());
            if (isNaN(fechaInicio) || fechaInicio < today) {
                document.getElementById('fechaInicioError').textContent =
                    'Start date must be today or later.';
                isValid = false;
            }

            if (isNaN(fechaFin) || fechaFin <= fechaInicio) {
                document.getElementById('fechaFinError').textContent =
                    'End date must be after the start date.';
                isValid = false;
            }

            // Original price
            const precioOriginal = parseFloat(
                document.getElementById('precio_original').value,
            );
            if (isNaN(precioOriginal)) {
                document.getElementById('precioOriginalError').textContent =
                    'Original price must be a number.';
                isValid = false;
            }

            // Discounted price
            const precioDescuento = parseFloat(
                document.getElementById('precio_descuento').value,
            );
            if (isNaN(precioDescuento) || precioDescuento >= precioOriginal) {
                document.getElementById('precioDescuentoError').textContent =
                    'Discounted price must be a number and less than the original price.';
                isValid = false;
            }

            // Link
            const enlace = document.getElementById('enlace').value;
            const urlPattern = /^https?:\/\/www\./;
            if (!urlPattern.test(enlace)) {
                document.getElementById('enlaceError').textContent =
                    "Link must be a valid URL starting with 'https://www'.";
                isValid = false;
            }
            if (!isValid) {
                e.preventDefault();
            } else if (isValid) {
                e.preventDefault();

                const data = {
                    titulo: titulo,
                    descripcion: descripcion,
                    tipo_oferta: tipoOferta.value,
                    codigo_cupon: codigoCupon.value,
                    cadena: cadena,
                    provincia: provincia,
                    fecha_inicio: document.getElementById('fecha_inicio').value,
                    fecha_fin: document.getElementById('fecha_fin').value,
                    precio_original: precioOriginal,
                    precio_descuento: precioDescuento,
                    enlace: enlace,
                    usuario: '{{ Auth::user()->name }}',
                };

                try {
                    const response = await fetch(`/offers/{{ $offer->id }}`, {
                        method: 'PUT',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document
                                .querySelector('meta[name="csrf-token"]')
                                .getAttribute('content'),
                        },
                        credentials: 'same-origin',
                        body: JSON.stringify(data),
                    });

                    if (response.ok) {
                        document
                            .getElementById('submited-p')
                            .classList.remove('hidden');
                        setTimeout(() => {
                            document
                                .getElementById('submited-p')
                                .classList.add('hidden');
                        }, 3000);
                        console.log(response);
                    } else {
                        console.error('Failed to update offer');
                    }
                } catch (error) {
                    console.error('Error:', error);
                }
            }
        });
    });
</script>
