<input x-data
    x-ref="input"
    x-init="
    pika = new Pikaday({ field: $refs.input,
    i18n: { previousMonth : 'Предыдущий месяц',
            nextMonth     : 'Следующий месяц',
            months        : ['Январь' , 'Февраль' , 'Март' , 'Апрель' , 'Май' , 'Июнь' , 'Июль' , 'Август' , 'Сентябрь' , 'Октябрь' , 'Ноябрь' , 'Декабрь'],
            weekdays      : ['понедельник','вторник','среда','четверг','пятница','суббота','воскресенье'],
            weekdaysShort : ['Вс','Пн','Вт','Ср','Чт','Пт','Сб']
    },
    firstDay:1,
    onOpen() {
        let dateParts = $refs.input.value.split('/');
        let dateObject = new Date(+dateParts[2], dateParts[1] - 1, +dateParts[0]);
        this.setDate(dateObject);
    },
    format: 'DD/MM/YYYY',
     toString(date, format) {
        const day = date.getDate();
        const month = date.getMonth() + 1;
        const year = date.getFullYear();
        const formattedDate = [
            day < 10 ? '0' + day : day
           ,month < 10 ? '0' + month : month
           ,year
          ].join('/');
        return formattedDate;
    } });"
    type="text"

    {{ $attributes->merge(['class' => 'rounded-md shadow-sm border-gray-300 focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50']) }}
>
