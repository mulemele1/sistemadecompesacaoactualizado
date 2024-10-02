@section('js')
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
    <script>
        function mostrarValor() {
            var input1Value = document.getElementById("motivo").value;
            var input2Container = document.getElementById("containerValor");

            if (input1Value.trim() !== "") {
                input2Container.classList.remove("escondido");
            } else {
                input2Container.classList.add("escondido");
            }
        }

        function updateInputValue(selectElement) {
            var selectedDataId = selectElement.value;
            var selectedData = {!! $projectos->toJson() !!};

            var selectedValue = '';
            for (var i = 0; i < selectedData.length; i++) {
                if (selectedData[i].id == selectedDataId) {
                    selectedValue = selectedData[i].valor_participante;
                    break;
                }
            }

            document.getElementById('valor').value = selectedValue;
        }
        $(document).ready(function() {
            $('#participante').select2();
        });
    </script>
@endsection
@section('css')
    <style>
        .escondido {
            display: none;
        }
    </style>
@endsection
