@props(['disabled' => false, 'options' => []])

<select @disabled($disabled) {{ $attributes->merge(['class' => 'border-gray-300 dark:border-gray-700 dark:bg-gray-900 dark:text-gray-300 focus:border-indigo-500 dark:focus:border-indigo-600 focus:ring-indigo-500 dark:focus:ring-indigo-600 rounded-md shadow-sm']) }}>
    <option value=""></option>
    @foreach ($options as $key => $value)
        <option :key="$key" >{{$value}}</option>
    @endforeach
</select>
