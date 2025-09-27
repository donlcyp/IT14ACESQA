<!DOCTYPE html>
<html lang="en">
<head>
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <meta charset="utf-8" />
    <title>AJJ CRISBER Engineering Services - Quality Assurance</title>
    <link href="https://fonts.googleapis.com/css2?family=Zen+Dots&family=Source+Code+Pro:wght@400;500&family=Inter:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
    <style>
        :root {
            --gray-500: #667085;
            --white: #ffffff;
            --gray-300: #d0d5dd;
            --gray-400: #e9e9e9;
            --blue-1: #1c57b6;
            --black-1: #313131;
            --text-lg-medium-font-family: "Inter", sans-serif;
            --text-lg-medium-font-weight: 500;
            --text-lg-medium-font-size: 18px;
            --text-lg-medium-line-height: 28px;
            --text-md-normal-font-family: "Inter", sans-serif;
            --text-md-normal-font-weight: 400;
            --text-md-normal-font-size: 16px;
            --text-md-normal-line-height: 24px;
            --text-sm-medium-font-family: "Inter", sans-serif;
            --text-sm-medium-font-weight: 500;
            --text-sm-medium-font-size: 14px;
            --text-sm-medium-line-height: 20px;
            --text-headline-small-bold-font-family: "Inter", sans-serif;
            --text-headline-small-bold-font-weight: 700;
            --text-headline-small-bold-font-size: 18px;
            --text-headline-small-bold-line-height: 28px;
            --shadow-xs: 0 1px 2px rgba(16, 24, 40, 0.05);
            --shadow-md: 0 6px 6px rgba(0, 0, 0, 0.1);
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            -webkit-font-smoothing: antialiased;
        }

        body {
            font-family: var(--text-md-normal-font-family);
            background-color: #aab0be;
        }

        .qa-1 {
            width: 100%;
            max-width: 1440px;
            margin: 0 auto;
            padding: 20px;
            position: relative;
            overflow: hidden;
        }

        .rectangle-15 {
            width: 100%;
            height: 86px;
            background: linear-gradient(90deg, #4a90e2, #87cefa);
            position: absolute;
            top: 0;
            left: 0;
        }

        .ajj-crisber-engineering-services {
            color: #000000;
            font-family: "Zen Dots", sans-serif;
            font-size: 24px;
            font-weight: 400;
            position: absolute;
            left: 80px;
            top: 30px;
        }

        .menu {
            position: absolute;
            left: 20px;
            top: 20px;
            width: 40px;
            height: 40px;
            background: none;
            border: none;
            cursor: pointer;
            font-size: 24px;
            color: #000;
        }

        .menu i {
            color: #000;
        }

        .panel-2 {
            width: calc(100% - 40px);
            max-width: 1289px;
            height: 90%;
            background: rgba(255, 255, 255, 0.1);
            border-radius: 10px;
            position: absolute;
            left: 20px;
            top: 100px;
        }

        .card-header {
            background: #f5f5f5;
            border-radius: 10px;
            box-shadow: 0 4px 4px rgba(0, 0, 0, 0.25);
            width: calc(100% - 40px);
            max-width: 1180px;
            margin: 120px auto 0;
            padding: 20px;
        }

        .content {
            display: flex;
            align-items: center;
            gap: 16px;
            flex-wrap: wrap;
        }

        .text-and-supporting-text {
            flex: 1;
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .text-and-badge {
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .text {
            color: #101828;
            font-family: var(--text-lg-medium-font-family);
            font-size: var(--text-lg-medium-font-size);
            font-weight: var(--text-lg-medium-font-weight);
            line-height: var(--text-lg-medium-line-height);
        }

        .badge {
            width: 100px;
            height: 20px;
            background: linear-gradient(90deg, #e0e0e0, #f0f0f0);
            border-radius: 10px;
        }

        .button {
            background: none;
            border: none;
            cursor: pointer;
            padding: 8px;
            border-radius: 8px;
        }

        .button-base {
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 8px;
            border-radius: 8px;
            background: #fff;
            box-shadow: var(--shadow-xs);
        }

        .frame {
            font-size: 16px;
            color: #344054;
        }

        .input-dropdown-base {
            width: 100%;
            max-width: 350px;
        }

        .input-with-label {
            display: flex;
            flex-direction: column;
            gap: 6px;
        }

        .input {
            background: var(--white);
            border: 1px solid var(--gray-300);
            border-radius: 8px;
            padding: 10px;
            display: flex;
            align-items: center;
            box-shadow: var(--shadow-xs);
        }

        .content2 {
            display: flex;
            align-items: center;
            gap: 8px;
            flex: 1;
        }

        .search {
            font-size: 16px;
            color: #344054;
        }

        .text2 {
            color: var(--gray-500);
            font-family: var(--text-md-normal-font-family);
            font-size: var(--text-md-normal-font-size);
            font-weight: var(--text-md-normal-font-weight);
            line-height: var(--text-md-normal-line-height);
            border: none;
            background: transparent;
            flex: 1;
        }

        .button-7 {
            background: none;
            border: none;
            cursor: pointer;
        }

        .button-base2 {
            background: #ffffff;
            border-radius: 8px;
            padding: 10px 16px;
            display: flex;
            align-items: center;
            gap: 8px;
            box-shadow: var(--shadow-xs);
        }

        .filter-lines {
            font-size: 16px;
            color: #344054;
        }

        .text3 {
            color: #344054;
            font-family: var(--text-sm-medium-font-family);
            font-size: var(--text-sm-medium-font-size);
            font-weight: var(--text-sm-medium-font-weight);
            line-height: var(--text-sm-medium-line-height);
        }

        .cards {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
            margin: 20px auto;
            width: calc(100% - 40px);
            max-width: 1180px;
        }

        .card-1, .card-2, .card-3 {
            background: #ffffff;
            border-radius: 12px;
            padding: 16px;
            width: 100%;
            max-width: 349px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            transition: transform 0.2s ease;
        }

        .card-1:hover, .card-2:hover, .card-3:hover {
            transform: translateY(-4px);
        }

        .content3 {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .with-picture {
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .picture, .picture2, .picture3 {
            width: 32px;
            height: 32px;
            border-radius: 50%;
        }

        .picture { background: #520d0d; }
        .picture2 { background: #1b59f8; }
        .picture3 { background: #f81bc8; }

        .headline-and-details {
            display: flex;
            flex-direction: column;
            gap: 4px;
        }

        .assumption-school, .dr-a-p-medical-center, .first-pacific-inn {
            color: #000000;
            font-family: "Source Code Pro", sans-serif;
            font-size: 18px;
            font-weight: 500;
        }

        .client-name-mrs-maria-lopez-inspected-by-engr-dela-cruz,
        .client-name-dr-arturo-pingoy-inspected-by-engr-ramirez,
        .client-name-mr-ramon-cruz-inspected-by-engr-flores {
            color: #3c3c43;
            font-family: "Source Code Pro", sans-serif;
            font-size: 14px;
            font-weight: 400;
        }

        ._30-mins-ago {
            color: rgba(102, 102, 102, 0.6);
            font-family: "Source Code Pro", sans-serif;
            font-size: 12px;
            text-align: right;
        }

        .new-button, .button-base4 {
            background: none;
            border: none;
            cursor: pointer;
        }

        .button-base3, .button-base4 {
            display: flex;
            align-items: center;
            gap: 8px;
            padding: 8px 16px;
            border-radius: 8px;
            color: #ffffff;
            transition: opacity 0.2s ease;
        }

        .button-base3 {
            background: #0084ff;
        }

        .button-base4 {
            background: #ff0000;
        }

        .qlementine-icons-new-16, .mingcute-edit-line {
            font-size: 16px;
        }

        .text4 {
            color: #ffffff;
            font-family: var(--text-sm-medium-font-family);
            font-size: var(--text-sm-medium-font-size);
            font-weight: var(--text-sm-medium-font-weight);
            line-height: var(--text-sm-medium-line-height);
        }

        /* Modal Styles */
        .qa-modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 0, 0, 0.5);
            align-items: center;
            justify-content: center;
            z-index: 1000;
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .qa-modal.active {
            display: flex;
            opacity: 1;
        }

        .modal {
            background: var(--white);
            border-radius: 8px;
            border: 1px solid var(--gray-400);
            padding: 24px;
            width: 100%;
            max-width: 442px;
            box-shadow: var(--shadow-md);
            position: relative;
        }

        .icon {
            width: 40px;
            height: 40px;
            background: #4a90e2;
            border-radius: 8px;
            position: absolute;
            left: 21px;
            top: 19px;
        }

        .add-quality-assurance-record {
            color: var(--black-1);
            font-family: var(--text-headline-small-bold-font-family);
            font-size: var(--text-headline-small-bold-font-size);
            font-weight: var(--text-headline-small-bold-font-weight);
            line-height: var(--text-headline-small-bold-line-height);
            margin: 60px 0 20px;
        }

        .input, .input2, .input3 {
            display: flex;
            flex-direction: column;
            gap: 2px;
            width: 100%;
            margin-bottom: 16px;
        }

        .frame-5 {
            display: flex;
            align-items: flex-start;
        }

        .label {
            color: var(--black-1);
            font-family: var(--text-md-normal-font-family);
            font-size: var(--text-sm-medium-font-size);
            font-weight: var(--text-sm-medium-font-weight);
            line-height: var(--text-sm-medium-line-height);
        }

        .input-md {
            background: var(--white);
            border: 1px solid #c0d5de;
            border-radius: 4px;
            padding: 8px 10px;
            display: flex;
            align-items: center;
            gap: 4px;
        }

        .input-md input {
            border: none;
            background: transparent;
            flex: 1;
            font-family: var(--text-md-normal-font-family);
            font-size: var(--text-sm-medium-font-size);
            color: #313131;
        }

        .input-md input::placeholder {
            color: #d9d9d9;
        }

        .input-md input:focus {
            outline: none;
        }

        .vector, .vector2, .gridicons-dropdown {
            display: none; /* Hide placeholders */
        }

        .utility-icons-heroicons-mini {
            width: 16px;
            height: 16px;
            background: #666;
            border-radius: 4px;
        }

        .btns {
            display: flex;
            gap: 12px;
            justify-content: flex-end;
            margin-top: 20px;
        }

        .button, .button3 {
            border-radius: 4px;
            padding: 8px 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            cursor: pointer;
            box-shadow: var(--shadow-xs);
        }

        .button {
            background: var(--white);
            border: 1px solid var(--gray-400);
        }

        .button2 {
            color: var(--black-1);
            font-family: var(--text-md-normal-font-family);
            font-size: var(--text-sm-medium-font-size);
            font-weight: var(--text-sm-medium-font-weight);
            line-height: var(--text-sm-medium-line-height);
        }

        .button3 {
            background: var(--blue-1);
        }

        .button4 {
            color: var(--white);
            font-family: var(--text-headline-small-bold-font-family);
            font-size: var(--text-sm-medium-font-size);
            font-weight: var(--text-headline-small-bold-font-weight);
            line-height: var(--text-sm-medium-line-height);
        }

        .button:hover, .button3:hover {
            opacity: 0.9;
        }

        button:focus-visible, input:focus-visible {
            outline: 2px solid #4a90e2;
            outline-offset: 2px;
        }

        .error {
            color: #dc3545;
            font-size: 0.875em;
            margin-top: 0.25rem;
        }

        @media (max-width: 768px) {
            .qa-1 {
                padding: 10px;
            }

            .card-header, .cards {
                margin: 100px auto 0;
            }

            .cards {
                flex-direction: column;
                align-items: center;
            }

            .card-1, .card-2, .card-3 {
                max-width: 100%;
            }

            .ajj-crisber-engineering-services {
                left: 60px;
                font-size: 20px;
            }

            .modal {
                width: 90%;
            }
        }
    </style>
</head>
<body>
    <main class="qa-1">
        <div class="rectangle-15"></div>
        <header>
            <button class="menu" aria-label="Open menu"><i class="fas fa-bars"></i></button>
            <h1 class="ajj-crisber-engineering-services">AJJ CRISBER Engineering Services</h1>
        </header>
        <div class="panel-2"></div>
        <section class="card-header">
            <div class="content">
                <div class="text-and-supporting-text">
                    <div class="text-and-badge">
                        <h2 class="text">Quality Assurance</h2>
                        <div class="badge"></div>
                    </div>
                </div>
                <button class="button" aria-label="Additional options">
                    <div class="button-base">
                        <i class="frame fas fa-ellipsis-h"></i>
                    </div>
                </button>
                <form action="{{ route('quality-assurance') }}" method="GET">
                    <div class="input-dropdown-base">
                        <div class="input-with-label">
                            <div class="input">
                                <div class="content2">
                                    <i class="search fas fa-search"></i>
                                    <input class="text2" name="search" placeholder="Search" type="search" aria-label="Search quality assurance records" value="{{ request('search') }}" />
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <button class="button-7" aria-label="Filter options">
                    <div class="button-base2">
                        <i class="filter-lines fas fa-filter"></i>
                        <span class="text3">Filters</span>
                    </div>
                </button>
            </div>
        </section>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <section class="cards" aria-label="Quality assurance records">
            @foreach($records as $index => $record)
                <article class="card-{{ $index + 1 }}">
                    <div class="content3">
                        <div class="with-picture">
                            <div class="picture{{ $index === 0 ? '' : ($index === 1 ? '2' : '3') }}" style="background-color: {{ $record->color }}"></div>
                            <div class="headline-and-details">
                                <h3 class="{{ $index === 0 ? 'assumption-school' : ($index === 1 ? 'dr-a-p-medical-center' : 'first-pacific-inn') }}">{{ $record->title }}</h3>
                                <p class="{{ $index === 0 ? 'client-name-mrs-maria-lopez-inspected-by-engr-dela-cruz' : ($index === 1 ? 'client-name-dr-arturo-pingoy-inspected-by-engr-ramirez' : 'client-name-mr-ramon-cruz-inspected-by-engr-flores') }}">
                                    Client Name: {{ $record->client }}<br />Inspected by: {{ $record->inspector }}
                                </p>
                            </div>
                        </div>
                    </div>
                    <div class="_30-mins-ago">{{ $record->time }}</div>
                    <form action="{{ route('quality-assurance.destroy', $record->id) }}" method="POST">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="button-base4" aria-label="Delete record">
                            <i class="mingcute-edit-line fas fa-trash"></i>
                            <span class="text4">Delete</span>
                        </button>
                    </form>
                </article>
            @endforeach
        </section>
        <div class="new-button">
            <button class="button-base3" onclick="document.querySelector('.qa-modal').classList.add('active')" aria-label="Add new record">
                <i class="qlementine-icons-new-16 fas fa-plus"></i>
                <span class="text4">New</span>
            </button>
        </div>
        <div class="qa-modal">
            <div class="modal">
                <div class="icon"></div>
                <h2 class="add-quality-assurance-record">Add Quality Assurance Record</h2>
                <form action="{{ route('quality-assurance.store') }}" method="POST">
                    @csrf
                    <div class="input">
                        <div class="frame-5">
                            <label class="label" for="project-name">Project Name</label>
                        </div>
                        <div class="input-md">
                            <input type="text" id="project-name" name="title" placeholder="Enter Project Name" required />
                        </div>
                        @error('title')
                            <span class="error text-danger small">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input2">
                        <div class="frame-5">
                            <label class="label" for="client-name">Client Name</label>
                        </div>
                        <div class="input-md">
                            <input type="text" id="client-name" name="client" placeholder="Enter Client Name" required />
                        </div>
                        @error('client')
                            <span class="error text-danger small">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input3">
                        <div class="frame-5">
                            <label class="label" for="inspector-name">Inspector Name</label>
                        </div>
                        <div class="input-md">
                            <input type="text" id="inspector-name" name="inspector" placeholder="Enter Inspector Name" required />
                            <div class="utility-icons-heroicons-mini"></div>
                        </div>
                        @error('inspector')
                            <span class="error text-danger small">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input">
                        <div class="frame-5">
                            <label class="label" for="time">Time</label>
                        </div>
                        <div class="input-md">
                            <input type="text" id="time" name="time" placeholder="Time (e.g., 30 mins ago)" required />
                        </div>
                        @error('time')
                            <span class="error text-danger small">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="input">
                        <div class="frame-5">
                            <label class="label" for="color">Color</label>
                        </div>
                        <div class="input-md">
                            <input type="text" id="color" name="color" placeholder="Color (e.g., #520d0d)" required />
                        </div>
                        @error('color')
                            <span class="error text-danger small">{{ $message }}</span>
                        @enderror
                    </div>
                    <div class="btns">
                        <button type="button" class="button" onclick="document.querySelector('.qa-modal').classList.remove('active')">
                            <span class="button2">Cancel</span>
                        </button>
                        <button type="submit" class="button3">
                            <span class="button4">Add</span>
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </main>
    <script>
        // Close modal when clicking outside
        document.querySelector('.qa-modal').addEventListener('click', function(e) {
            if (e.target === this) {
                this.classList.remove('active');
            }
        });
    </script>
</body>
</html>
