document.addEventListener("DOMContentLoaded", () => {
    let currentPage = 1;
    const perPage = 10;

    const fetchOffers = async (
        page,
        search = "",
        startDate = "",
        endDate = "",
        type = "",
    ) => {
        const spinner = document.getElementById("spinner");
        spinner.style.display = "block";

        const searchParams = new URLSearchParams();
        searchParams.append("page", page);
        searchParams.append("per_page", perPage);

        const searchTerms = search.match(/@(\w+)\s+("[^"]+"|[^@]+)/g);
        if (searchTerms) {
            searchTerms.forEach((term) => {
                const [_, key, value] = term.match(/@(\w+)\s+("[^"]+"|[^@]+)/);
                if (["id", "company", "creator"].includes(key)) {
                    searchParams.append(key, value.replace(/"/g, "").trim());
                }
            });
            search = search.replace(/@(\w+)\s+("[^"]+"|[^@]+)/g, "").trim();
        }

        if (search) {
            searchParams.append("search", search);
        }

        if (startDate) {
            searchParams.append("startDate", startDate);
        }

        if (endDate) {
            searchParams.append("endDate", endDate);
        }

        if (type && type !== "both") {
            searchParams.append("type", type);
        }

        console.log(searchParams.toString());

        const response = await fetch(`/api/offers?${searchParams.toString()}`);
        const data = await response.json();
        const tbody = document.querySelector("tbody");
        tbody.innerHTML = "";

        data.data.forEach((offer) => {
            const row = document.createElement("tr");
            row.classList.add("hover:bg-gray-100", "hover:cursor-pointer");
            row.innerHTML = `
                <td class="py-2 px-4 border border-gray-200 text-center">${offer.id}</td>
                <td class="py-2 px-4 border border-gray-200">${offer.titulo}</td>
                <td class="py-2 px-4 border border-gray-200">${offer.cadena}</td>
                <td class="py-2 px-4 border border-gray-200">${offer.tipo_oferta}</td>
                <td class="py-2 px-4 border border-gray-200">${offer.fecha_inicio}</td>
                <td class="py-2 px-4 border border-gray-200">${offer.fecha_fin}</td>
                <td class="py-2 px-4 border border-gray-200">${offer.usuario}</td>
            `;
            tbody.appendChild(row);
        });

        document.getElementById("previous").disabled =
            data.prev_page_url === null;
        document.getElementById("next").disabled = data.next_page_url === null;
        document.getElementById("actualPage").textContent = currentPage;
        spinner.style.display = "none";
    };

    document.getElementById("previous").addEventListener("click", () => {
        if (currentPage > 1) {
            currentPage--;
            fetchOffers(
                currentPage,
                document.getElementById("search").value,
                document.getElementById("startDate").value,
                document.getElementById("endDate").value,
                document.getElementById("type").value,
            );
        }
    });

    document.getElementById("next").addEventListener("click", () => {
        currentPage++;
        fetchOffers(
            currentPage,
            document.getElementById("search").value,
            document.getElementById("startDate").value,
            document.getElementById("endDate").value,
            document.getElementById("type").value,
        );
    });

    const searchButtonFunc = () => {
        currentPage = 1;
        fetchOffers(
            currentPage,
            document.getElementById("search").value,
            document.getElementById("startDate").value,
            document.getElementById("endDate").value,
            document.getElementById("type").value,
        );
    };

    document
        .getElementById("searchButton")
        .addEventListener("click", () => searchButtonFunc());
    document.getElementById("search").addEventListener("keydown", (e) => {
        if (e.key === "Enter") {
            searchButtonFunc();
        }
    });

    const searchInput = document.getElementById("search");
    const startDateInput = document.getElementById("startDate");
    const endDateInput = document.getElementById("endDate");
    const typeSelect = document.getElementById("type");

    const updateSearch = () => {
        currentPage = 1;
        fetchOffers(
            currentPage,
            searchInput.value,
            startDateInput.value,
            endDateInput.value,
            typeSelect.value,
        );
    };

    // searchInput.addEventListener("input", updateSearch);
    startDateInput.addEventListener("change", updateSearch);
    endDateInput.addEventListener("change", updateSearch);
    typeSelect.addEventListener("change", updateSearch);

    fetchOffers(currentPage);

    // SVG de filtro click
    const filterButton = document.getElementById("filterButton");
    const filters = document.getElementById("filters");
    let inFilter = false;

    filterButton.addEventListener("click", () => {
        if (inFilter) return;

        inFilter = true;
        if (filters.classList.contains("show")) {
            filters.classList.remove("show");
            filters.classList.add("hide");
            setTimeout(() => {
                filters.style.display = "none";
                inFilter = false;
            }, 500);
        } else {
            filters.classList.remove("hide");
            filters.classList.add("show");
            filters.style.display = "flex";
            setTimeout(() => {
                filters.style.display = "flex";
                inFilter = false;
            }, 500);
        }
    });
});
