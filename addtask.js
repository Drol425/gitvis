$(document).ready(function(){
    let tasks = [{
        id: 0,
        status: ''
    }];

    let statuslist = ['backlog', 'todo', 'inprogress', 'done'];

    $('#addTaskBtn').on('click', function(){
        let inpVal = $('#taskName').val();
        let areaVal = $('#infoTask').val();
        
        let divPortlet = document.createElement('div');
        divPortlet.className = 'portlet';
        
        let divPortletHeader = document.createElement('div');
        divPortletHeader.className='portlet-header';

        let h5Name = document.createElement('h5');
        
        let divTaskControls = document.createElement('div');
        divTaskControls.className = 'task-controls';
        
        let btn1 = document.createElement('button');
        
        let btn2 = document.createElement('button');
       
        let i1 = document.createElement('i');
        i1.className='fa fa-clock-o fa-1x';
        let i2 = document.createElement('i');
        i2.className='fa fa-trash-o fa-1x';
        let divPortletContent = document.createElement('div');
        divPortletContent.className = 'portlet-content';
        
        
        divPortlet.appendChild(divPortletHeader);
        divPortlet.appendChild(divPortletContent);
        divPortletHeader.appendChild(h5Name);
        divPortletHeader.appendChild(divTaskControls);
        let text = document.createTextNode(inpVal);
        h5Name.appendChild(text);
        divTaskControls.appendChild(btn1);
        divTaskControls.appendChild(btn2);
        btn1.appendChild(i1);
        btn2.appendChild(i2);
        let text2 = document.createTextNode(areaVal);
        
        divPortletContent.appendChild(text2);
        let i = tasks.length;
        tasks[i] = {
            id: tasks.length,
            status: statuslist[0]
        }
        divPortlet.id = i;
        $('#backlog').append(divPortlet);
        console.log(tasks[i].id + tasks[i].status);
    });
});